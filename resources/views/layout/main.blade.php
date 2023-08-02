<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    @yield('link')
    <title>@yield('title')</title>
</head>
<body>
    
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color:cornflowerblue">
        <p class="navbar-brand col-md-3 col-lg-2 me-0 fs-6" href="#" style="padding-left: 3rem;"><i class="fa fa-laptop"></i> Resto</p>
        <span></span>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="{{ url('logout') }}"><i class="fa fa-power-off"></i> Log out</a>
          </div>
        </div>
      </header>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="height: 93vh; background-color:rgb(99, 177, 246)">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ url('admin') }}" class="nav-link active" aria-current="page"><i class="fa fa-home"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('meja') }}" class="nav-link active" aria-current="page"><i class="fa fa-table"></i> Meja</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('role') }}" class="nav-link active" aria-current="page"><i class="fa fa-regular fa-splotch"></i> Role</a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{ url('gallery') }}" class="nav-link active" aria-current="page"><i class="fa fa-solid fa-layer-group"></i> Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('kategori') }}" class="nav-link active" aria-current="page"><i class="fa fa-solid fa-layer-group"></i> Kategori</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('chef') }}" class="nav-link active" aria-current="page"><i class="fa fa-solid fa-utensils"></i> Chef</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('menu') }}" class="nav-link active" aria-current="page"><i class="fa fa-solid fa-utensils"></i> Menu</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('bahan_baku') }}" class="nav-link active" aria-current="page"><i class="fa fa-solid fa-seedling"></i> Bahan Baku</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('resep') }}" class="nav-link active" aria-current="page"><i class="fa fa-solid fa-calendar-minus"></i> Resep</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('rekening') }}" class="nav-link active" aria-current="page"><i class="fa fa-solid fa-calendar-minus"></i> Pengaturan Pembayaran</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>