@extends('home')

@section('title', 'Riwayat')
    
@section('content')
    @foreach($transaksi as $item)
        <p>Kode Transaksi : {{ $item->kode_transaksi }}</p>
        <p>Kode Transaksi : {{ $item->total_harga }}</p>
    @endforeach
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>Nama barang</th>
                <th>Jumlah barang</th>
                <th>Harga satuan</th>
                <th>Total harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nama barang</th>
                <th>Jumlah barang</th>
                <th>Harga satuan</th>
                <th>Total harga</th>
                <th>Tanggal</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($transaksi as $items)
                @foreach($items->details as $detail)
                <tr>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah_barang_satuan }}</td>
                    <td>{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ number_format($detail->total_harga, 0, ',', ',') }}</td>
                    <td>{{ $detail->created_at }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection