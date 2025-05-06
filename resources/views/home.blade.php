<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <<title>@yield('title') - Aplikasi Warung</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

        {{-- Style Local --}}
        <link rel="stylesheet" href="css/styleLocal.css">


        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        {{-- Header --}}
        @include('layout.header')
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                {{-- side-bar --}}
               @include('layout.sideBar');
            </div>
            <div id="layoutSidenav_content">
                
                <main>
                    {{-- validasi --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                    @endif
                    

                      {{-- content --}}
                      <div class="container-fluid px-4">
                        <h1 class="mt-4">@yield('title')</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                            @yield('content')
                    </div>
                </main>

                {{-- footer --}}
                @include('layout.footer')
            </div>
        </div>

        {{-- Modal --}}
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


        {{-- bootstrap --}}
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        {{-- jquery --}}
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script src="//code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="{{ asset('Auto-Format-Currency-With-jQuery/simple.money.format.js') }}"></script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    </body>
</html>

