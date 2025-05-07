@extends('home')

@section('title', 'Detail transaksi')
    
@section('content')   
        <p>Id Transaksi : {{ $detail_transaksi->kode_transaksi }}</p>
        <table id="datatablesSimple" class="display">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Satuan Barang</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga Barang</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Satuan Barang</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga Barang</th>
                    <th>Waktu</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($detail_transaksi->details as $items)
                <tr>
                    <td>{{ $items->barang->nama_barang }}</td>
                    <td>{{ $items->jumlah_barang_satuan }} barang</td>
                    <td>Rp.{{ number_format($items->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp.{{ number_format($items->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $items->created_at }}</td>
                </tr>
                @endforeach
                <!-- Baris total harga -->
            </tbody>
        </table>
        
        <div class="mt-5">
            <h4>
            <strong>Total Harga:</strong>
            <strong>Rp.{{ number_format($detail_transaksi->total_harga, 0, ',', '.') }}</strong>
        </h4>
        </div>
      
        
@endsection