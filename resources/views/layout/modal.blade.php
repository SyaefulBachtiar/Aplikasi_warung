<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('create.store') }}">
                @csrf
                <div class="input-group mb-4">
                    <label for="nama_barang" class="input-group-text">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
                </div>
                <div class="input-group mb-4">
                    <label for="deskripsi" class="input-group-text">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi"class="form-control" required></textarea>
                </div>
                <div class="input-group mb-4">
                    <label for="harga_barang" class="input-group-text">Harga</label>
                    <input type="text" id="harga_barang" name="harga" required value="" class=" form-control money">
                </div>
                <div class="input-group mb-4">
                    <label for="kategori" class="input-group-text">Kategori</label>
                    <input type="text" id="kategori" name="kategori" class="form-control" required>
                </div>
                <div class="input-group mb-4">
                    <label for="jumlah_barang" class="input-group-text">Jumlah Barang</label>
                    <input type="number" id="jumlah_barang" name="jumlah_barang" class="form-control" required>
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