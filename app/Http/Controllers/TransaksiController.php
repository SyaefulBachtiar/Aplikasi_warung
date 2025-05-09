<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barangModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\transaksiDetailModel;
use App\Models\transaksiModel;

class TransaksiController
{
    function index()
    {
        $transaksi = transaksiModel::with(['details.barang'])->get();
        if($transaksi->isNotEmpty()){
            $total_jumlah = transaksiDetailModel::where('transaksi_id', $transaksi->first()->id)->sum('jumlah_barang_satuan');
            return view('app.user_riwayat', compact('transaksi', 'total_jumlah'));
        }else{
            return view('app.user_riwayat', compact('transaksi'));
        }
     

    }

    // detail 
    function detail($id)
    {
        $detail_transaksi = transaksiModel::with(['details.barang'])->findOrFail($id);
        return view('app.user_detail_transaksi', compact('detail_transaksi'));
    }

    // delete
    function delete ($id)
    {
        try{

            transaksiModel::where('id', $id)->delete();

            return redirect()->back()->with('success', 'Berhasil menghapush!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }

    // chart
    function chart()
    {
        return view('app.grafik_keuangan');
    }

    // Grafik
    function grafik()
    {


        $perhari = TransaksiModel::select(
            DB::raw('DAY(created_at) as tanggal'),
            DB::raw('MONTHNAME(created_at) as bulan'),
            DB::raw('MONTH(created_at) as bulan_angka'),
            DB::raw('YEAR(created_at) as tahun'),
            DB::raw('SUM(total_harga) as total')
        )
        ->groupBy(
            DB::raw('DAY(created_at)'),
            DB::raw('MONTHNAME(created_at)'),
            DB::raw('MONTH(created_at)'),
            DB::raw('YEAR(created_at)')
        )
        ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
        ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
        ->orderBy(DB::raw('DAY(created_at)'), 'ASC')
        ->get();

        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();

        $perBulan = TransaksiModel::select(
            DB::raw('YEAR(created_at) as tahun'),
            DB::raw('MONTH(created_at) as bulan_angka'),
            DB::raw('MONTHNAME(created_at) as nama_bulan'),
            DB::raw('SUM(total_harga) as total')
        )
        ->where(function ($query) use ($now, $lastMonth) {
            $query->whereYear('created_at', $now->year)
                  ->whereMonth('created_at', $now->month)
                  ->orWhere(function ($q) use ($lastMonth) {
                      $q->whereYear('created_at', $lastMonth->year)
                        ->whereMonth('created_at', $lastMonth->month);
                  });
        })
        ->groupBy(
            DB::raw('YEAR(created_at)'),
            DB::raw('MONTH(created_at)'),
            DB::raw('MONTHNAME(created_at)')
        )
        ->orderBy('tahun')
        ->orderBy('bulan_angka')
        ->get();

        // foreach($data as $items){
        //     echo 'Tanggal', $items->tanggal;
        //     echo '<br>';
        //     echo 'bulan', $items->bulan;
        //     echo '<br>';
        //     echo 'Tahun', $items->tahun;
        //     echo '<br>';
        //     echo 'Total', $items->total;
        //     echo '<br>';
        // }


        return response()->json([
            'harian' => $perhari,
            'bulanan' => $perBulan
        ]);
    }
    
}
