<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Katalog Menu</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Katalog Menu</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  {{-- <style>
    #hero{
      background: url("{{ asset('images/hero-bg.jpg') }}") top center;
    }
    .about{
      background: url("{{ asset('images/about-bg.jpg') }}") center center;
    }
  </style> --}}

</head>

<body>

  

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0">
        @if (count($countresto)==0)
          Restaurant
        @else
          {{ $resto->nama_resto }}
        @endif
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"></a> -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
          <li><a class="nav-link scrollto" href="#chefs">Chefs</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      @if (!Auth::user())
          <a href="{{ url('login') }}" class="login-btn scrollto d-none d-lg-flex">Login</a>
      @else
          <a href="{{ url('logout') }}" class="login-btn scrollto d-none d-lg-flex">Logout</a>
      @endif
      

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Selamat Datang ke <span>
            @if (count($countresto)==0)
                Restaurant
            @else
                {{ $resto->nama_resto }}
            @endif  
          </span></h1>
          <h2>Menyajikan makanan dengan sepenuh Hati!</h2>
          <h2>(Untuk memesan silahkan Login lalu ke Reservasi)</h2>

          <div class="btns">
            <a href="#menu" class="btn-menu animated fadeInUp scrollto">Menu Kami</a>
            <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Reservasi</a>
            @if (!Auth::user())
                <a href="{{ url('login') }}" class="btn-login animated fadeInUp scrollto">Login</a>
            @else
                <a href="{{ url('logout') }}" class="btn-login animated fadeInUp scrollto">Logout</a>
            @endif
            
          </div>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="{{ asset('fotoresto/'.$resto->foto) }}" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Deskripsi Restaurant</h3>
            <p class="fst-italic">
              @if (count($countresto)==0)
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
              @else
                  {{ $resto->desc }}
              @endif
              
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Menu</h2>
          <p>Menu</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="*" class="filter-active">Semua</li>
              @if (count($kategori)!=0)
                  @foreach ($kategori as $item)
                      <li data-filter=".filter-{{ $item->kategori }}">{{ $item->kategori }}</li>
                  @endforeach
              @endif
            </ul>
          </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

          @if (count($menu)==0)
              <h1>Belum ada Data Menu!</h1>
          @else
              @foreach ($menu as $item)
              <div class="col-lg-6 menu-item filter-{{ $item->Kategori_Menu->kategori }}">
            <img src="{{ asset('fotomenu/'.$item->foto) }}" class="menu-img" alt="">
            <div class="menu-content">
              {{ $item->nama_menu }}<span>{{ format_rupiah($item->harga)  }}</span>
            </div>
            <div class="menu-ingredients">
              {{ $item->desc }}
            </div>
          </div>
          @endforeach
          @endif

        </div>

      </div>
    </section><!-- End Menu Section -->

    <!-- ======= Reservasi Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Reservasi</h2>
          <p>Reservasi</p>
        </div>

          @if (Auth::user())
              <div class="text-center"><button type="button" data-bs-toggle="modal" data-bs-target="#ModalReservasi"><i class="fa fa-solid fa-scroll"></i>Reservasi</button></div>
          @else
              <div class="text-center"><button type="button"><a href="{{ url('login') }}" class="btn-login animated fadeInUp scrollto">Silahkan Login Terlebih Dahulu!</a></button></div>
          @endif

      </div>
    </section><!-- End Reservasi Section -->

    {{-- Modal Section --}}
    @if (Auth::user())
    

    <div class="modal fade modal-xl" id="ModalReservasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Info Reservasi dari {{ Auth::user()->name }}</h1>
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
    <h3 style="color: black">Reservasi No : {{ $loop->iteration }}</h3>
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
                          <th>Customer | Atas Nama</th>
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
                              <td>{{ $item->user->name }} @if ($item->nama != null)
                                   | {{ $item->nama }}
                              @endif</td>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Tambah Reservasi</h1>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Bayar Pakai Apa?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              @foreach ($rekening as $item)
              <div class="form-check">
                <input class="form-check-input" type="radio" name="bank" id="bank" value="{{ $item->id }}">
                <label class="form-check-label" for="bank" style="color: black">{{ $item->bank }}</label>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Tambah Menu</h1>
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
              
              <div class="card card-body" style="color: black">
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
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Edit Reservasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ url('reservasi_editProcess',$item->id) }}" method="post">
              @method('patch')
              @csrf
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input name="kode" class="form-control" id="kode" placeholder="Kode" value="{{ $item->code }}" readonly type="text">
              <label for="kode" class="form-label">Kode</label>
            </div>
            <div class="form-floating mb-3">
              <input name="user" class="form-control" id="user" placeholder="User" value="{{ $item->user->name }}" readonly type="text">
              <label for="user" class="form-label">User Pengguna</label>
            </div>
            <div class="form-floating mb-3">
              <input name="nama" class="form-control" id="nama" placeholder="Nama" value="{{ $item->nama }}" type="text">
              <label for="nama" class="form-label" style="color: #6E7173">Atas Nama</label>
            </div>
            <div class="form-floating mb-3">
              <select name="nomor_meja" id="nomor_meja" class="form-select" aria-label="Floating label select example">
                      <option value="{{ $item->nomor_meja }}">{{ $item->nomor_meja }}</option>
                  @foreach ($meja as $item_m)
                      <option value="{{ $item_m->nomor_meja }}">{{ $item_m->nomor_meja }}</option>
                  @endforeach
              </select>
              <label for="nomor_meja">Kategori</label>
            </div>
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

    {{-- End Modal Section --}}


    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">

      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Gallery</h2>
          <p>Beberapa Gambar yang ada di Restaurant Kami</p>
        </div>
      </div>

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

          @if (count($gallery)==0)
              <h1>Belum Ada Gallery</h1>
            @else
              @foreach ($gallery as $item)
                  <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                      <a class="gallery-lightbox" data-gall="gallery-item">
                      <img src="{{ asset('fotogallery/'.$item->foto) }}" alt="" class="img-fluid">
                      </a>
                  </div>
          </div>
              @endforeach
          @endif

          

        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Chefs Section ======= -->
    <section id="chefs" class="chefs">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Chefs</h2>
          <p>Chefs Kami</p>
        </div>

        <div class="row">

          @if (count($chef)==0)
              <h1>Belum ada Chef!</h1>
          @else
              @foreach ($chef as $item)
          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="100">
              <img src="{{ asset('fotochef/'.$item->foto) }}" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>{{ $item->nama_chef }}</h4>
                  <span>{{ $item->bagian }}</span>
                </div>
              </div>
            </div>
          </div>
              @endforeach
          @endif
          

        </div>

      </div>
    </section><!-- End Chefs Section -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>