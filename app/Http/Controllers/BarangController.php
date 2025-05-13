<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barangModel;
use App\Models\transaksiModel;
use App\Models\transaksiDetailModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BarangController
{
    private $user_id;

    public function __construct()
    {
        $this->user_id = Auth::id();
    }

    public function index()
    {
        
        $data = barangModel::where('users_id', $this->user_id)->get();
        if($data->isNotEmpty()){
        return view('app.user_home', array_merge(compact('data')));
        }else{
            $data = collect();
            return view('app.user_home', array_merge(compact('data')));
        }
    }

    public function daftar_barang()
    {
        $data = barangModel::where('users_id', $this->user_id)->get();
        if($data->isNotEmpty()){
        return view('app.user_table_barang', compact('data'));
        }else{
            $data = collect();
            return view('app.user_table_barang', compact('data'));
        }


    }

    // input barang
    public function store(Request $request)
    {  
        $validated = $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'jumlah_barang' => 'required|integer',
        ]);
        
        $validated['users_id'] = Auth::id();
        barangModel::create($validated);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan');
        
    }

    function transaksi(Request $request)
    {
        DB::beginTransaction();


        try {
            // zonna waktu
            $waktuJakarta = Carbon::now('Asia/Jakarta');
            // id barang
            $id_barang = $request->input('id_barang');
            // kode transaksi
            $kode_transaksi = $request->input('kode_transaksi');
            // total semua jumlah belanja
            $total_harga = $request->input('total');
            $total_harga_tanpaRP = preg_replace('/[^\d]/', '', $total_harga);
            // harga barang satuan
            $harga_satuan = array_map(function ($val) {
                return preg_replace('/[^0-9]/', '', $val);
            }, $request->input('harga'));
            // jumlah barang satuan
            $jumlah_satuan = array_map(function ($val) {
                return preg_replace('/[^0-9]/', '', $val);
            }, $request->input('jumlah_satuan'));

        
            $request->validate([
                  'kode_transaksi' => 'required',
                  'total' => 'required'
            ]);
            
            $transaksi = transaksiModel::create([
                'users_id' => $this->user_id,
                'kode_transaksi' => $kode_transaksi,
                'total_harga' => $total_harga_tanpaRP,
                'created_at' => $waktuJakarta
            ]);



            for ($i = 0; $i < count($id_barang); $i++) {
                $jumlah_harga_satuan = (int)$harga_satuan[$i] * (int)$jumlah_satuan[$i];

                transaksiDetailModel::create([
                    'users_id' => $this->user_id,
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => (int)$id_barang[$i],
                    'jumlah_barang_satuan' => (int)$jumlah_satuan[$i],
                    'harga_satuan' => (int)$harga_satuan[$i],
                    'total_harga' => $jumlah_harga_satuan,
                    'created_at' => $waktuJakarta,
                    'updated_at' => $waktuJakarta
                ]);
            }
        

        
            DB::commit();
        
            return redirect()->back()->with('success', 'Transaksi berhasil');
        
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaksi gagal: ' . $e->getMessage());
        }
    }

    // update
    function update(Request $request, $id)
    {
        $barang = barangModel::findOrFail($id);
        $barang->update($request->all());

        return redirect()->back()->with('success', 'Berhasil update barang');
    }

    // delete barang
    function delete($id)
    {
        try{
            barangModel::where('id', $id)->delete();

            return redirect()->back()->with('success', 'berhasil delete barang');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Gagal delete barang', $e->getMessage());
        }
    }
}
