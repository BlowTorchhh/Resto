<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Katalog Menu</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @if (Auth::user())
      @if (session('success') || session('error'))
        <script type="text/javascript">
          window.onload = () => {
            $('#ModalMenu').modal('show');
          }
        </script>
      @endif
      @if (session('status'))
      <script type="text/javascript">
        window.onload = () => {
          $('#ModalReservasi').modal('show');
        }
      </script>
      @endif
    @endif
    <style>
      .content {
        background-size: cover;
        background-position: center center;
        height: 93vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
      }
      .content h1 {
        font-size: 3rem;
        text-align: center;
        margin-bottom: 0;
      }
      .content p {
        font-size: 1.5rem;
        text-align: center;
        margin-top: 0;
      }
    </style>

</head>
<body >
  <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color:cornflowerblue">
    <p class="navbar-brand col-md-3 col-lg-2 me-0 fs-6" href="#" style="padding-left: 3rem;"><i class="fa fa-laptop"></i> Resto</p>
    <span></span>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
        @if (!Auth::user())
        <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="{{ url('login') }}"><i class="fa fa-power-off"></i> Login</a>
        </div>
        </div>
        @endif
        @if (Auth::user())
        <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a href="#" class="nav-link px-3" data-bs-toggle="modal" data-bs-target="#ModalReservasi"><i class="fa fa-solid fa-scroll"></i>Lihat Reservasi</a>
        </div>
        </div>
        <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="{{ url('logout') }}"><i class="fa fa-power-off"></i> Log out</a>
        </div>
        </div>
        @endif
      
    </div>
  </header>
  
    @if (Auth::user())
    

    <div class="modal fade modal-xl" id="ModalReservasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Info Reservasi dari {{ Auth::user()->name }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if (session('status'))
        <div class="alert alert-success d-flex justify-content-center position-relative alert-dismissible" style="position: absolute; z-index: 1065;" role="alert">
          <div >
            <b>{{ session('status') }}</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      @endif

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
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Tambah
              </button>
              
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
                              <td>{{ $item->rekening->bank }}</td>
                              <td>{{ $item->status }}</td>
                              <td class="text-center">

                                  <a href="{{ url('print_table',$item->code) }}" type="button" class="btn btn-print btn-info" target="_blank" rel="noopener noreferrer"> Print</a>
                                
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#Modaledit{{ $item->id }}">
                                      Edit
                                  </button>
          
                                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $item->id }}">
                                      Hapus
                                  </button>
                              </td>
                          </tr>
                          @endforeach
                  </tbody>
              </table>    
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          </div>
      </form>
        </div>
      </div>
    </div>
  

  <form action="{{ url('reservasi_addProcess') }}" method="post">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Reservasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="form-floating mb-3">
                  <input name="jam_booking" id="jam_booking" required class="form-control" placeholder="Jam Booking" type="time">
                  <label for="jam_booking" class="form-label">Jam Booking</label>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-target="#ModalReservasi" data-bs-toggle="modal">Kembali Ke Reservasi</button>
            <button type="button" class="btn btn-primary" id="btn_jam_booking" data-bs-target="#ModalMenu" disabled data-bs-toggle="modal">Berikutnya</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      // ambil elemen input
const inputTime = document.getElementById("jam_booking");

if (localStorage.getItem("inputTimeValue")) {
  // jika ada, set nilai input dari localStorage
  document.getElementById("jam_booking").value = localStorage.getItem("inputTimeValue");
  document.getElementById("btn_jam_booking").disabled = false;
}
// tambahkan event listener untuk memeriksa saat input diubah
inputTime.addEventListener("input", function() {
  // jika input kosong, nonaktifkan tombol
  if (!this.value) {
    document.getElementById("btn_jam_booking").disabled = true;
  } else {
    document.getElementById("btn_jam_booking").disabled = false;
  }
  localStorage.setItem("inputTimeValue", this.value);
});
    </script>
    <div class="modal fade" id="ModalPayment" tabindex="-1" aria-labelledby="exampleModalLabel" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Pakai Apa?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              @foreach ($rekening as $item)
              <div class="form-check">
                <input class="form-check-input" type="radio" name="bank" id="bank" value="{{ $item->id }}">
                <label class="form-check-label" for="bank">{{ $item->bank }}</label>
              </div>
              @endforeach
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-target="#ModalMenu" data-bs-toggle="modal">Kembali Ke Menu</button>
            <button type="submit" id="submit_reservasi" class="btn btn-success" disabled >Tambah Reservasi</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      // ambil elemen tombol submit
const submitButton = document.getElementById("submit_reservasi");
const radioButtons = document.querySelectorAll("input[id='bank']");

radioButtons.forEach(function(radioButton) {
  radioButton.addEventListener("click", function() {
    // periksa apakah salah satu opsi radio dipilih
    const isChecked = Array.from(radioButtons).some(function(button) {
      return button.checked;
    });
    
    // aktifkan atau nonaktifkan tombol tergantung pada hasil pengecekan
    if (isChecked) {
      submitButton.disabled = false;
    } else {
      submitButton.disabled = true;
    }
  });
});
// tambahkan event listener untuk menangani saat tombol submit ditekan
submitButton.addEventListener("click", function() {
  // hapus data dari localStorage dengan kunci "inputValue"
  localStorage.removeItem("inputTimeValue");
});
    </script>

  </form>

{{-- Keranjang --}}
    <div class="modal fade modal-xl" id="ModalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if (session('success'))
        <div class="alert alert-success d-flex justify-content-center position-relative alert-dismissible" style="position: absolute; z-index: 1065;" role="alert">
          <div >
            <b>{{ session('success') }}</b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      @endif
      @if (session('error'))
  <div class="alert alert-danger d-flex justify-content-center position-relative alert-dismissible" style="position: absolute; z-index: 1065;" role="alert">
    <div >
      <b>{{ session('error') }}</b>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif
            <button class="btn btn-info mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#keranjang" aria-expanded="false" aria-controls="collapseExample">
              Info keranjang
            </button>

            <div class="collapse" id="keranjang" style="position: absolute; z-index: 1060; top: 10px; left: 30%;">
              
              <div class="card card-body">
                @if (!session('cart') || empty(session('cart')) || count(session('cart')) == 0)
                    Belum ada data Di keranjang
                @endif
                @if (session('cart'))
                <div class="card-body table-responsive">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Nama Menu</th>
                              <th>Jumlah</th>
                              <th>Harga Per Porsi</th>
                              <th>Subtotal</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      @php
                          $grandtotal = 0;
                      @endphp
                      <tbody>
                      @foreach ($cart as $ct => $item)
                              <tr>
                                  <td>{{ $loop->iteration }} </td>
                                  <td>{{ $item['nama_menu'] }}</td>
                                  <td>{{ $item['jumlah'] }} Porsi</td>
                                  <td>{{ format_rupiah($item['harga']) }}</td>
                                  <td>{{ format_rupiah($item['subtotal']) }}</td>
                                  <td class="text-center">
                                    <form action="{{ url('keranjang_hapus',$ct) }}" method="POST">
                                      @method('delete')
                                      @csrf
                                      <button type="submit" class="btn btn-danger">
                                          Batal
                                      </button>
                                    </form>
                                  </td>
                              </tr>
                              @php
                                  $grandtotal += $item['subtotal'];
                              @endphp
                      @endforeach
                              <tr>
                                <th colspan="4">Grand Total</th>
                                <th>{{ format_rupiah($grandtotal) }}</th>
                                <th>
                                  <form action="{{ url('deleteAllCart') }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                      Batalkan Semua
                                  </button>
                                  </form>
                                </th>
                              </tr>
                      </tbody>
                  </table>    
            <button type="button" class="btn btn-primary" data-bs-target="#ModalPayment" data-bs-toggle="modal">Berikutnya</button>
              </div>
                @endif
              </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($menu as $item)
            
              <div class="col">
                <div class="card">
                  <img src="{{ asset('fotomenu/'.$item->foto) }}" class="card-img-top" style="width: auto; height: 200px;" alt="menu">
                  <div class="card-body">
                    <h5 class="card-title">{{ $item->nama_menu }}</h5>
                    <p class="card-text"><b>Harga </b>{{ format_rupiah($item->harga) }}</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#keranjang{{ $item->id }}" aria-expanded="false" aria-controls="collapseExample">
                      Masukkan ke keranjang
                    </button>
                    
                    <div class="collapse" id="keranjang{{ $item->id }}" style="position: absolute; z-index: 1060; top: 10px; right: 60px;">
                      <div class="card card-body">
                        <form action="{{ url('keranjang_add',$item->id) }}" method="post">
                          @csrf
                          <div class="form-floating mb-3">
                            <input name="jumlah" id="porsi" class="form-control" placeholder="Porsi" type="number">
                            <label for="porsi" class="form-label">Berapa Porsi {{ $item->nama_menu }}</label>
                        </div>
                          <button type="submit" class="btn btn-success">Tambah ke keranjang</button>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            
            @endforeach
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-target="#exampleModal" data-bs-toggle="modal">Kembali ke Jam Booking</button>
            
          </div>
        </div>
      </div>
    </div>
  
  

    @foreach ($reservasi as $item)
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
                  <input name="jam_booking" class="form-control" id="jam_booking" placeholder="Jam Booking" value="{{ $item->jam_booking }}" type="time">
                  <label for="jam_booking" class="form-label">Jam Booking</label>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-target="#ModalReservasi" data-bs-toggle="modal">Kembali Ke Reservasi</button>
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    @endforeach

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
                      <div class="modal-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>Kode</th>
                                  <th>Nomor Meja</th>
                                  <th>Customer</th>
                                  <th>Jam Booking</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->nomor_meja }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->jam_booking }}</td>
                            <td>{{ $item->status }}</td>
                          </tbody>
                        </table>
                      </div>
                    
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-target="#ModalReservasi" data-bs-toggle="modal">Kembali Ke Reservasi</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
    @endforeach
    
    @endif

    <div class="content" style="background-image: url({{ asset('images/background-resto.jpg') }});">
      <div class="container" style="background-color: black; opacity:0.9;">
        <h1>Selamat Datang di Restoran </h1>
        <h1>Los Pollos Hermanos Family</h1>
        <p>Jl. Panyileukan no 5 Rt. 05 Rw. 9 </p>
      </div>
    </div>
    
    <div class="content" style="background-image: url({{ asset('images/background-resto.jpg') }});">
      @if (count($menu) == 0)
      <div class="container" style="background-color: black; opacity:0.9;">
        <h1>Belum ada menu yang tersedia </h1>
      </div>
      @endif
      @if (count($menu) != 0)
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="container mb-3 rounded" style="background-color: black; opacity:0.9;">
          <h1>Pilihan Menu Yang Tersedia </h1>
          <p>*(Untuk memesan silahkan login lalu lihat Reservasi di Menu atas)</p>
        </div>
        <div class="carousel-indicators">
          @foreach ($menu as $key => $item)
          <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{ $key }}" class="active" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key }}"></button>
          @endforeach
        </div>
        <div class="carousel-inner">
          @foreach ($menu as $key => $item)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" >
            <img src="{{ asset('fotomenu/'.$item->foto) }}" class="d-block w-100" alt="..." style="width: 100vh; height: 300px;">
            <div class="carousel-caption d-none d-md-block rounded" style="opacity:0.8; background-color:black;">
              <h5>{{ $item->nama_menu }}</h5>
              <p><b>Harga</b> {{ format_rupiah($item->harga) }}</p>
            </div>
          </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      @endif
          </div>
    
</body>
</html>