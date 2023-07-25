@extends('layout.app')

@section('title')
    Login
@endsection

@section('content')
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
<div class="container">
    <div class="body d-md-flex align-items-center justify-content-between">
        <div class="box-1 mt-md-0 ">
            <img src="{{ asset('images/background.jfif') }}"
                class="" alt="">
        </div>
        <div class=" box-2 d-flex flex-column h-100">
            <div class="mt-1">
                <p class="mb-5 h-1">Silahkan Login</p>
                <div class="d-flex flex-column ">
                    <div class="d-flex align-items-center">
                        <form action="{{ ('login') }}" method="POST">
                            @csrf
                            <div>
                                <label >Masukkan Username</label>
                                <input type="text" name="username" class="form-control form-table">
                            </div>
                            <div>
                                <label >Masukkan Password</label>
                                <input type="password" id="id_password" name="password" class="form-control form-table">
                                <i class="far fa-eye" id="togglePassword" style="float: right;
                    margin-top: -25px;
                    position: relative;
                    z-index: 2;"></i>
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0 text-muted">Belum punya akun?</p>
                        <a href="{{ url('register') }}" class="btn btn-primary">Registrasi<span class="fas fa-chevron-right ms-1"></span></a>
                    </div>
                </div>
            </div>
            <div class="mt-auto">
            </div>
        </div>
    </div>
</div>
<script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
      });
</script>
@endsection