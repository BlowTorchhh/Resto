@extends('layout.main')

@section('title')
    Meja
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
                <th>Nomor Meja</th>
                <th>Status</th>
                @if (auth()->user()->id_role == "1")
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $item->nomor_meja }}</td>
                    <td>{{ $item->status }}</td>
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
                <div class="modal fade" id="ModalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="ModalEditLabel">Edit Meja</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('meja_edit',$item->id) }}" method="post">
                            @method('patch')
                            @csrf
                        <div class="modal-body">
                          <div class="form-floating mb-3">
                            <input name="nomor_meja" class="form-control" placeholder="Nomor Meja" id="nomor_meja" value="{{ $item->nomor_meja }}" type="number">
                            <label for="nomor_meja" class="form-label">Nomor Meja</label>
                          </div>
                          <div class="form-floating mb-3">
                            <select name="status" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option hidden value="{{ $item->status }}">{{ $item->status }}</option>
                                <option value="Kosong">Kosong</option>
                                <option value="Di-Booking">Di-Booking</option>
                                <option value="Di-Isi">Di-Isi</option>
                            </select>
                            <label for="floatingSelect">Pilih Status</label>
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Meja</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('meja_addProcess') }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input name="nomor_meja" id="nomor_meja" class="form-control" placeholder="Nomor Meja" type="number">
                    <label for="nomor_meja" class="form-label">Nomor Meja</label>
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
      @foreach ($data as $item)
  <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" aria-labelledby="ModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalLabelDelete">Yakin Hapus {{ $item->nomor_meja }}?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('meja_delete',$item->id) }}" method="post">
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