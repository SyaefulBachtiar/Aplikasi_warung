@extends('home')

@section('title', 'Home')
    
@section('content')
{{-- Data Barang --}}
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
    @foreach($data as $produk)
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title" id="nama-{{ $produk->id }}">{{ $produk->nama_barang }}</h5>
                <p class="card-text">{{ $produk->deskripsi }}</p>
                <p class="card-text"><strong>Kategori:</strong> {{ $produk->kategori }}</p>
                <p class="card-text" id="harga-{{ $produk->id }}">Rp.{{ number_format($produk->harga, 0, ',', '.') }}</p>
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="kurang({{ $produk->id }})">-</button>
                    <span id="jumlah-{{ $produk->id }}" class="mx-3">0</span>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="tambah({{ $produk->id }})">+</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm ms-2" onclick="reset({{ $produk->id }})">Reset</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>



<div class="card mb-4">
    <div class="card-header">
        Total
    </div>
    <div class="card-body" style="overflow-x: auto;">
        <form method="post" id="inp" action="{{ route('simpan-transaksi') }}">
            @csrf
           <ul id="list-info">
                
           </ul>
            <div class="mb-4">
                <input type="text" id="kode_transaksi" name="kode_transaksi" value="" required readonly hidden>
                <p>Total</p>
                <input type="text" id="total" name="total"  required value="" readonly>
            </div>

            <button type="submit" id="btnBayar" class="btn btn-primary" disabled>Bayar</button>
        </form>
    </div>
</div>


{{-- <div class="card mb-4">
    <div class="card-header">
        Total
    </div>
    <div class="card-body">
        <form method="post" id="inp" action="{{ route('simpan-transaksi') }}">
            @csrf
            <ul id="list-info">
                <li style="list-style: none">
                    <input type="text" disabled value="Nama Barang" >
                    <input type="text" disabled value="Jumlah Barang">
                    <input type="text" disabled value="Harga Barang">
                    <input type="text" disabled value="Jumlah harga per produk">
                </li>
            </ul>
            <div class="mb-4">
                <input type="text" id="kode_transaksi" name="kode_transaksi" value="" required readonly hidden>
                <p>Total</p>
                <input type="text" id="total" name="total"  required value="" readonly>
            </div>

            <button type="submit" id="btnBayar" class="btn btn-primary" disabled>Bayar</button>
        </form>
    </div>
</div> --}}


<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Area Chart Example
            </div>
            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Bar Chart Example
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>
@endsection