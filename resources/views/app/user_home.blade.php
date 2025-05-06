@extends('home')

@section('title', 'Home')
    
@section('content')
{{-- Data Barang --}}
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>kategori</th>
                    <th>Jumlah Barang</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>kategori</th>
                    <th>Jumlah Barang</th>

                </tr>
            </tfoot>
            <tbody>
                @foreach($data as $produk)
                <tr>
                    <form method="POST" action="">

                    <td><span id="nama-{{ $produk->id }}">{{ $produk->nama_barang }}</span></td>
                    <td><input type="text" id="deskripsi" value="{{ $produk->deskripsi }}"  disabled required></td>
                    <td><input type="text" id="harga-{{ $produk->id }}" disabled value="Rp.{{ number_format($produk->harga, 0, ',', '.') }}" required></td>
                    <td>{{ $produk->kategori }}</td>
                    <td>
                        <div style="display: flex; justify-content: space-between; align-items: center; width:100px">
                        <button onclick="kurang({{ $produk->id }})">-</button>
                        <span id="jumlah-{{ $produk->id }}" class="m-2">0</span>
                        <button onclick="tambah({{ $produk->id }})" class="me-2">+</button>
                        <button onclick="reset({{ $produk->id }})" >Reset</button>
                        </div>
                    </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="card mb-4">
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
                <input type="text" id="total" name="total" required value="" readonly>
            </div>

            <button type="submit" id="btnBayar" class="btn btn-primary" disabled>Bayar</button>
        </form>
    </div>
</div>


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