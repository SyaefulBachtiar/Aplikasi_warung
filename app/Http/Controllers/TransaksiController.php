<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barangModel;
use App\Models\transaksiDetailModel;
use App\Models\transaksiModel;

class TransaksiController
{
    function index()
    {
        $transaksi = transaksiModel::with(['details.barang'])->get();
        return view('app.user_riwayat', compact('transaksi'));

    }
}
