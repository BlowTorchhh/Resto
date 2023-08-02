@extends('layout.main')

@section('link')
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
@foreach ($reservasi as $item)
            @if (count($reservasi)>0)
            <div class="collapse" id="struk" style="position: absolute; z-index: 1060; top: 10px; right: 30%;">
              
              <div class="card card-body">
                <div class="card-body table-responsive">
                  @foreach ($struks as $reservasiId => $strukItems)
    <h3>Reservasi No : {{ $loop->iteration }}</h3>
    <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Menu</th>
                <th>Jumlah Porsi</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
            @endphp
            @foreach ($strukItems->first() as $index => $struk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $struk->menu->nama_menu }}</td>
                    <td>{{ $struk->jumlah }} Porsi</td>
                    <td>{{ format_rupiah($struk->menu->harga) }}</td>
                    <td>{{ format_rupiah($struk->subtotal) }}</td>
                </tr>
                @php
                    $grandTotal += $struk->subtotal;
                @endphp
            @endforeach
            <tr>
                <td colspan="4" align="right"><strong>Total:</strong></td>
                <td>{{ format_rupiah($grandTotal) }}</td>
            </tr>
        </tbody>
    </table>
@endforeach

 
      </div>
      </div>
    </div>
    @endif
            @endforeach

<div class="card-body table-responsive">
    @if (count($reservasi)>0)
              <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#struk" aria-expanded="false" aria-controls="collapseExample">
                Detail
              </button>
              @endif

    <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nomor Meja</th>
                <th>Customer</th>
                <th>Jam Booking</th>
                <th>Pembayaran</th>
                <th>Status</th>
                @if (auth()->user()->id_role == "1")
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach ($reservasi as $item_r)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $item_r->code }}</td>
                    <td>{{ $item_r->nomor_meja }}</td>
                    <td>{{ $item_r->user->name }}</td>
                    <td>{{ $item_r->jam_booking }}</td>
                    <td>{{ $item_r->rekening->bank }}</td>
                    <td>{{ $item_r->status }}</td>
                    @if (auth()->user()->id_role == "1")
                    <td class="text-center">

                        <a href="{{ url('print_table',$item->code) }}" type="button" class="btn btn-print btn-info" target="_blank" rel="noopener noreferrer"> Print</a>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item_r->id }}">
                            Edit
                        </button>
                    </td>
                    @endif
                </tr>
                <div class="modal fade" id="exampleModal{{ $item_r->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Reservasi</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('reservasi_edit',$item_r->id) }}" method="post">
                            @method('patch')
                            @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input name="kode" class="form-control" id="kode" placeholder="Kode" value="{{ $item_r->code }}" type="text">
                                <label for="kode" class="form-label">Kode</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="nomor_meja" class="form-control" id="nomor_meja" placeholder="Nomor Meja" value="{{ $item_r->nomor_meja }}" type="text">
                                <label for="nomor_meja" class="form-label">Nomor Meja</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input readonly class="form-control" id="nama" placeholder="Nama" value="{{ $item_r->user->name }}" type="text">
                                <label for="nama" class="form-labbel">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="jam_booking" class="form-control" id="jam_booking" placeholder="Jam Booking" value="{{ $item_r->jam_booking }}" type="time">
                                <label for="jam_booking" class="form-label">Jam Booking</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select name="status" id="status" class="form-select" aria-label="Floating label select example">
                                    <option hidden value="{{ $item_r->status }}">{{ $item_r->status }}</option>
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
@if (auth()->user()->id_role=='1')
    

@if (count($resto)==0)
  <script type="text/javascript">
          window.onload = () => {
            $('#staticBackdrop').modal('show');
          }
        </script>

  <!-- Modal -->
  <form action="{{ url('resto_addProcess') }}" method="post" enctype="multipart/form-data">
    @csrf
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Beri Info Resto</h1>
        </div>
        <div class="modal-body">
            <div class="form-floating mb-3">
                <input name="nama_resto" id="resto" class="form-control" placeholder="Resto" type="text">
                <label for="resto" class="form-label">Beri Nama Resto!</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="file" placeholder="Masukkan Gambar Resto" name="foto" required id="formFile" required onchange="showLoading()">
                <label for="formFile" class="form-label">Masukkan Gambar Resto</label>
                <div id="loading" class="d-none">
                  <i class="fa fa-spinner fa-spin"></i> Uploading...
                </div>
                <div id="success" class="d-none">
                  Upload berhasil!
                </div>
            </div>
            <div class="form-floating">
                <textarea name="desc" class="form-control" placeholder="Deskripsi" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Deskripsi</label>
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Selesai!</button>
        </div>
      </div>
    </div>
  </div>
  </form>
@endif
@endif
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
@endsection