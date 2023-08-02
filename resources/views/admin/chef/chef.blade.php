@extends('layout.main')

@section('title')
    Chef
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

      @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah
    </button>

    <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Bagian</th>
                <th>foto</th>
                @if (auth()->user()->id_role == "1")
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach ($chef as $item)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $item->nama_chef }}</td>
                    <td>{{ $item->bagian }}</td>
                    <td><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#Modalfoto{{ $item->id }}">
                            Detail Foto
                          </button></td>
                    @if (auth()->user()->id_role == "1")
                    <td class="text-center">
                        
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $item->id }}">
                            Edit
                          </button>
                          
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $item->id }}">
                            Hapus
                          </button>
                    </td>
                    @endif
                </tr>
                <div class="modal fade" id="ModalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Chef</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('chef_edit',$item->id) }}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input name="nama_chef" id="chef" class="form-control" value="{{ $item->nama_chef }}" placeholder="Chef" type="text">
                                <label for="chef" class="form-label">Nama Chef</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="bagian" id="bagian" class="form-control" placeholder="Bagian" value="{{ $item->bagian }}" type="text">
                                <label for="bagian" class="form-label">Bagian</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="foto" class="form-control" required placeholder="Foto" id="foto" value="{{ $item->foto }}" type="file">
                                <label for="foto" class="form-label">Foto</label>
                              </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Edit</button>
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Chef</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('chef_addProcess') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input name="nama_chef" id="chef" class="form-control" placeholder="Chef" type="text">
                    <label for="chef" class="form-label">Nama Chef</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="bagian" id="bagian" class="form-control" placeholder="Bagian" type="text">
                    <label for="bagian" class="form-label">Bagian</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="file" placeholder="Masukkan Gambar Gallery" name="foto" required id="formFile" required onchange="showLoading()">
                    <label for="formFile" class="form-label">Masukkan Gambar Chef</label>
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

      @foreach ($chef as $item)
      <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" aria-labelledby="ModalLabelDelete" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ModalLabelDelete">Yakin Hapus {{ $item->foto }}?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('chef_delete',$item->id) }}" method="post">
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

      @foreach ($chef as $item)
  <div class="modal fade " id="Modalfoto{{ $item->id }}" tabindex="-1" aria-labelledby="ModalLabelfoto" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalLabelfoto">Info Foto {{ $item->nama_menu }}?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <center>
          <img src="{{ asset('fotochef/'.$item->foto) }}" alt="Image" style="width: 450px; height: auto;"></td>
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