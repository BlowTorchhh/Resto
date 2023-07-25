@extends('layout.main')

@section('title')
    Kategori
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
                <th>Kategori</th>
                <th>Status</th>
                @if (auth()->user()->id_role == "1")
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach ($kategori as $item_k)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $item_k->kategori }}</td>
                    <td>{{ $item_k->status }}</td>
                    @if (auth()->user()->id_role == "1")
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $item_k->id }}">
                            Edit
                          </button>
                          
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $item_k->id }}">
                            Hapus
                          </button>
                    </td>
                    @endif
                </tr>
                <div class="modal fade" id="ModalEdit{{ $item_k->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('kategori_edit',$item_k->id) }}" method="post">
                            @method('patch')
                            @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input name="kategori" class="form-control" placeholder="Kategori" id="kategori" value="{{ $item_k->kategori }}" type="text">
                                <label for="kategori" class="form-label">Kategori</label>
                              </div>
                              <div class="form-floating mb-3">
                                <select name="status" id="status" class="form-select" aria-label="Floating label select example">
                                  <option hidden value="{{ $item_k->status }}">{{ $item_k->status }}</option>
                                  <option value="Aktif">Aktif</option>
                                  <option value="Non-Aktif">Non-Aktif</option>
                                </select>
                                <label for="status">Status</label>
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('kategori_addProcess') }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input name="kategori" class="form-control" id="kategori" placeholder="Kategori" type="text">
                    <label for="kategori" class="form-label">Kategori</label>
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

      @foreach ($kategori as $item_k)
      <div class="modal fade" id="ModalDelete{{ $item_k->id }}" tabindex="-1" aria-labelledby="ModalLabelDelete" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ModalLabelDelete">Yakin Hapus {{ $item_k->kategori }}?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('kategori_delete',$item_k->id) }}" method="post">
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
    @endsection