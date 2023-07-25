@extends('layout.customer')

@section('link')
    
@endsection

@section('title')
    Customer
@endsection

@section('content')
<div class="card-body table-responsive">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah
    </button>
    <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nomor Meja</th>
                <th>Customer</th>
                <th>Jam Booking</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($reservasi as $item)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->nomor_meja }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->jam_booking }}</td>
                    <td>{{ $item->status }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modaledit{{ $item->id }}">
                            Edit
                        </button>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $item->id }}">
                            Hapus
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="Modaledit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Reservasi</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('reservasi_editProcess',$item->id) }}" method="post">
                            @method('patch')
                            @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input name="kode" class="form-control" id="kode" placeholder="Kode" value="{{ $item->kode }}" type="text">
                                <label for="kode" class="form-label">Kode</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="nomor_meja" class="form-control" id="nomor_meja" placeholder="Nomor Meja" value="{{ $item->nomor_meja }}" type="text">
                                <label for="nomor_meja" class="form-label">Nomor Meja</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="jam_booking" class="form-control" id="jam_booking" placeholder="Jam Booking" value="{{ $item->jam_booking }}" type="time">
                                <label for="jam_booking" class="form-label">Jam Booking</label>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Reservasi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('reservasi_addProcess') }}" method="post">
            @csrf
        <div class="modal-body">
            <div class="form-floating mb-3">
                <input name="jam_booking" id="jam_booking" class="form-control" placeholder="Jam Booking" type="time">
                <label for="jam_booking" class="form-label">Jam Booking</label>
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

  @foreach ($reservasi as $item)
  <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" aria-labelledby="ModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalLabelDelete">Yakin Hapus Reservasi ?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('reservasi_delete',$item->id) }}" method="post">
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