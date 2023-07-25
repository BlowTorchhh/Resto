@extends('layout.main')

@section('title')
    Detail Resep 
@endsection

@section('content')
<div class="card-body table-responsive">
 @if ($count<=0)
    <center><h4>Belum ada resep dari menu {{ $menu->nama_menu }}</h4></center>
 @endif
 <a href="{{ url('menu') }}"><button class="btn btn-info">Kembali</button></a>
@if ($count>=1)
<table id="bootstrap-data-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Nama Bahan</th>
            <th>Takaran</th>
            @if (auth()->user()->id_role == "1")
            <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $item->menu->nama_menu }}</td>
                <td>{{ $item->bahan_baku->nama_bahan }}</td>
                <td>{{ $item->takaran }}</td>
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
                    <h1 class="modal-title fs-5" id="ModalEditLabel">Edit Resep</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ url('resep_edit',$item->id) }}" method="post">
                    @method('patch')
                    @csrf
                  <div class="modal-body">
                    <div class="form-floating mb-3">
                      <input readonly class="form-control" placeholder="Nama Menu" id="menu" value="{{ $item->menu->nama_menu }}" type="text">
                      <label for="menu" class="form-label">Nama Menu</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input readonly class="form-control" placeholder="Bahan Baku" id="bahan_baku" value="{{ $item->bahan_baku->nama_bahan }}" type="text">
                      <label for="bahan_baku" class="form-label">Bahan Baku</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input name="takaran" class="form-control" placeholder="Takaran" id="takaran" value="{{ $item->takaran }}" type="number">
                    <label for="takaran" class="form-label">Takaran</label>
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

@foreach ($data as $item)
  <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" aria-labelledby="ModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalLabelDelete">Yakin Hapus Menu {{ $item->menu->nama_menu }} dan Bahan {{ $item->bahan_baku->nama }}?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('resep_delete',$item->id) }}" method="post">
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
@endif
</div>
@endsection