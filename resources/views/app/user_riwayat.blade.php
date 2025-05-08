@extends('home')

@section('title', 'Riwayat')
    
@section('content')
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>Kode transaksi</th>
                <th>Jumlah barang</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Info</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Kode transaksi</th>
                <th>Jumlah barang</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Info</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($transaksi as $items)
            @php
             $total_jumlah = $items->details->sum('jumlah_barang_satuan');   
            @endphp
            <tr>
                
                
                    <td>{{ $items->kode_transaksi }}</td>
                    <td>{{ $total_jumlah}}</td>
                    <td>{{ $items->total_harga }}</td>
                    <td>{{ $items->created_at }}</td>
                    <td>
                        <a href="/detail/{{ $items->id }}" class="btn btn-primary">Detail</a>
                        <a href="/delete/{{ $items->id }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection