<div class="modal fade" id="ModalUpdateBarang{{ $items->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalUpdateBarangLabel{{ $items->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalUpdateBarangLabel">Input Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('/update_barang/'. $items->id) }}">
                @csrf
                @method('PUT')
                <div class="input-group mb-4">
                    <label for="nama_barang" class="input-group-text">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ $items->nama_barang }}" class="form-control" required>
                </div>
                <div class="input-group mb-4">
                    <label for="deskripsi" class="input-group-text">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" required>{{ $items->deskripsi }}</textarea>
                </div>
                <div class="input-group mb-4">
                    <label for="harga_barang" class="input-group-text">Harga</label>
                    <input type="text" id="harga_barang" name="harga" required value="{{ number_format($items->harga)}}" class=" form-control">
                </div>
                <div class="input-group mb-4">
                    <label for="kategori" class="input-group-text">Kategori</label>
                    <input type="text" id="kategori" name="kategori" value="{{ $items->kategori }}" class="form-control" required>
                </div>
                <div class="input-group mb-4">
                    <label for="jumlah_barang" class="input-group-text">Jumlah Barang</label>
                    <input type="number" id="jumlah_barang" name="jumlah_barang" value="{{ $items->jumlah_barang }}" class="form-control" required>
                </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
      </div>
    </div>
  </div>