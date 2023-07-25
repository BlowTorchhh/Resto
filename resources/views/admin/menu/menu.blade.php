@extends('layout.main')

@section('title')
    Menu
@endsection

@section('content')
<div class="card-body table-responsive">

  @if (session('status'))
        <div class="alert alert-success d-flex justify-content-center position-relative alert-dismissible" role="alert">
          <div >
            <b>{{ session('status') }}</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
  @endif

      @if (session('error'))
        <div class="alert alert-danger d-flex justify-content-center position-relative alert-dismissible" role="alert">
          <div >
            <b>{{ session('error') }}</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      @endif

<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah
</button>

<table id="bootstrap-data-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Kategori Halal</th>
            <th>Foto</th>
            @if (auth()->user()->id_role == "1")
            <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach ($menu as $item_m)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $item_m->nama_menu }}</td>
                <td>{{ $item_m->harga }}</td>
                <td>{{ $item_m->Kategori_Menu->kategori }}</td>
                <td>{{ $item_m->status }}</td>
                <td>{{ $item_m->kategori_halal }}</td>
                <td><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Modalfoto{{ $item_m->id }}">
                  Lihat Foto
                </button>
                @if (auth()->user()->id_role == "1")
                <td class="text-center">
                  <a href="{{ url('detail',$item_m->id) }}"><button type="button" class="btn btn-success" >Detail</button></a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $item_m->id }}">
                        Edit
                      </button>
                      
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $item_m->id }}">
                        Hapus
                      </button>
                </td>
                @endif
            </tr>
            <div class="modal fade" id="ModalEdit{{ $item_m->id }}" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="ModalEditLabel">Edit Kategori</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('menu_edit',$item_m->id) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                    <div class="modal-body">
                      <div class="form-floating mb-3">
                        <input name="nama_menu" class="form-control" placeholder="Nama Menu" id="nama_menu" value="{{ $item_m->nama_menu }}" type="text">
                        <label for="nama_menu" class="form-label">Nama Menu</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input name="harga" class="form-control" placeholder="Harga" id="harga" value="{{ $item_m->harga }}" type="number">
                        <label for="harga" class="form-label">Harga</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input name="kategori" readonly class="form-control" placeholder="Nama Menu" id="kategori" value="{{ $item_m->Kategori_Menu->kategori }}" type="text">
                        <label for="kategori" class="form-label">Kategori</label>
                      </div>
                      <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select" aria-label="Floating label select example">
                          <option hidden value="{{ $item_m->status }}">{{ $item_m->status }}</option>
                          <option value="Tersedia">Tersedia</option>
                          <option value="Habis">Habis</option>
                        </select>
                        <label for="status">Status</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="kategori_halal" id="kategori_halal" class="form-select" aria-label="Floating label select example">
                          <option hidden value="{{ $item_m->kategori_halal }}">{{ $item_m->kategori_halal }}</option>
                          <option value="Halal">Halal</option>
                          <option value="Non-Halal">Non-Halal</option>
                        </select>
                        <label for="kategori_halal">Kategori Halal</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" type="file" placeholder="Masukkan Gambar Menu" name="image2" required id="formFile" required onchange="showLoading()">
                      <label for="formFile" class="form-label">Masukkan Gambar Menu</label>
                      <div id="loading" class="d-none">
                        <i class="fa fa-spinner fa-spin"></i> Uploading...
                      </div>
                      <div id="success" class="d-none">
                        Upload berhasil!
                      </div>
                     </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">edit</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
    @endforeach
    </tbody>
</table>    

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('menu_addProcess') }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="form-floating mb-3">
                <input class="form-control" id="nama_menu" placeholder="Nama Menu" name="nama_menu" required type="text">
                <label class="form-label" for="nama_menu">Nama Menu</label>
            </div>
            <div class="form-floating mb-3">
                <input name="harga" id="harga" class="form-control" placeholder="Harga" type="number">
                <label for="harga" class="form-label">Harga</label>
            </div>
            <div class="form-floating mb-3">
                <select name="id_kategori" id="id_kategori" class="form-select" aria-label="Floating label select example">
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                    @endforeach
                </select>
                <label for="id_kategori">Kategori</label>
            </div>
            <div class="form-floating mb-3">
                <select name="kategori_halal" id="kategori_halal" class="form-select" aria-label="floating label select example">
                    <option value="Halal">Halal</option>
                    <option value="Non-Halal">Non-Halal</option>
                </select>
                <label for="kategori_halal">Kategori Halal</label>
            </div>
            <div class="form-floating mb-3">
                  <input class="form-control" type="file" placeholder="Masukkan Gambar Menu" name="image" id="formFile" required onchange="showLoading()">
                  <label for="formFile" class="form-label">Masukkan Gambar Menu</label>
                  <div id="loading" class="d-none">
                    <i class="fa fa-spinner fa-spin"></i> Uploading...
                  </div>
                  <div id="success" class="d-none">
                    Upload berhasil!
                  </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Tambah</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  @foreach ($menu as $item_m)
  <div class="modal fade" id="ModalDelete{{ $item_m->id }}" tabindex="-1" aria-labelledby="ModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalLabelDelete">Yakin Hapus {{ $item_m->nama_menu }}?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('menu_delete',$item_m->id) }}" method="post">
            @method('delete')
            @csrf
          
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach

  @foreach ($menu as $item_m)
  <div class="modal fade " id="Modalfoto{{ $item_m->id }}" tabindex="-1" aria-labelledby="ModalLabelfoto" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalLabelfoto">Info Foto {{ $item_m->nama_menu }}?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <center>
          <img src="{{ asset('fotomenu/'.$item_m->foto) }}" alt="Image" style="width: 450px; height: auto;"></td>
        </center>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach

  <script>
    function showLoading() {
      var loading = document.getElementById('loading');
      loading.classList.remove('d-none');

      setTimeout(function() {
    loading.classList.add('d-none');
    var success = document.getElementById('success');
    success.classList.remove('d-none');
  }, 3000);
    }
    </script>
@endsection