@extends('layout.main')

@section('title')
    Bahan Baku
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
                <th>Nama</th>
                <th>Jumlah Stok</th>
                @if (auth()->user()->id_role == "1")
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $item->nama_bahan }}</td>
                    <td>{{ $item->jumlah_stok }}</td>
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
                          <h1 class="modal-title fs-5" id="ModalEditLabel">Edit Bahan Baku</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('bahan_baku_edit',$item->id) }}" method="post">
                            @method('patch')
                            @csrf
                        <div class="modal-body">
                          <div class="form-floating mb-3">
                            <input name="nama_bahan" class="form-control" placeholder="Nama Bahan" id="nama_bahan" value="{{ $item->nama_bahan }}" type="text">
                            <label for="nama_bahan" class="form-label">Nama Bahan</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input name="jumlah_stok" class="form-control" placeholder="Jumlah Stok" id="jumlah_stok" value="{{ $item->jumlah_stok }}" type="text">
                            <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Bahan Baku</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('bahan_baku_addProcess') }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input name="nama_bahan" id="nama_bahan" class="form-control" placeholder="Bahan Baku" type="text">
                    <label for="nama_bahan" class="form-label">Bahan Baku</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="jumlah_stok" id="jumlah_stok" class="form-control" placeholder="Jumlah Stok" type="number">
                    <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
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
          <h1 class="modal-title fs-5" id="ModalLabelDelete">Yakin Hapus {{ $item->nama }}?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('bahan_baku_delete',$item->id) }}" method="post">
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