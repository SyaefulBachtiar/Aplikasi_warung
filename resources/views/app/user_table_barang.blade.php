@extends('home')

@section('title', 'Daftar barang')
    
@section('content')
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>Nama barang</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah barang</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nama barang</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah barang</th>
                <th>Opsi</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($data as $items)
            <tr>
                <td>{{ $items->nama_barang }}</td>
                <td>{{ $items->deskripsi }}</td>
                <td>{{ $items->kategori }}</td>
                <td>Rp.{{ number_format($items->harga, 0, ',', '.' )}}</td>
                <td>{{ $items->jumlah_barang }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalUpdateBarang{{ $items->id }}">Update</button>
                    <a href="/delete_barang/{{ $items->id }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @include('layout.modal_update_barang')
            @endforeach
        </tbody>
    </table>
@endsection