@extends('layout.register')
@section('head')
    <style>
        .btn.btn-primary {
    background-color: transparent;
    color: rgb(0, 64, 255);
    border: 0px;
    padding: 0;
    font-size: 14px;
    transition: color 0.4s linear;
}

.btn.btn-primary:hover {
    background-color: rgb(0, 64, 255);
    color: #ffffffdd;
}

.btn.btn-danger {
    background-color: transparent;
    color:#dc3545;
    border: 0px;
    padding: 0;
    font-size: 14px;
    transition: color 0.4s linear;
}

.btn.btn-danger:hover {
    background-color: #dc3545;
    color: #ffffffdd;
}
.border.border-success {
    border: 1px solid #dddd;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
}
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 2%">
            <div class="border border-success col-md-6 ">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <form action="{{ route('registerAction') }}" method="POST">
                @csrf
                <div class="mb-3 col-md-8">
                    <label>Nama <span class="text-danger">*</span></label>
                    <input class="form-control" name="name" value="{{ old('name') }}" type="text" >
                </div>
                <div class="mb-3 col-md-8">
                    <label>Username <span class="text-danger">*</span></label>
                    <input class="form-control" name="username" value="{{ old('username') }}" type="text">
                </div>
                <div class="mb-3 col-md-8">
                    <label>Email <span class="text-danger">*</span></label>
                    <input class="form-control" name="email" value="{{ old('email') }}" type="email" >
                </div>
                <div class="mb-3 col-md-8">
                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                    <input class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" type="date" >
                </div>
                <div class="mb-3 col-md-8">
                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                    <input class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" type="text" >
                </div>
                <div class="mb-3 col-md-8">
                    <label>Agama <span class="text-danger">*</span></label>
                    <input class="form-control" name="agama" value="{{ old('agama') }}" type="text" >
                </div>
                <div class="mb-3 col-md-8">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <input class="form-control" name="alamat" value="{{ old('alamat') }}" type="text" >
                </div>
                <div class="mb-3 col-md-8">
                    <label>Telepon <span class="text-danger">*</span></label>
                    <input class="form-control" name="telepon" value="{{ old('telepon') }}" type="number" >
                </div>
                <label for="jeniskelamin"> Pilih Jenis Kelamin</label>
                <select name="jeniskelamin" class="form-control" style="width: 67%">
                    <option value="Laki-laki">Laki - laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <div class="mb-3 col-md-8">
                    <label>Password <span class="text-danger">*</span></label>
                    <input class="form-control" name="password" type="password" id="id_password" >
                    <i class="far fa-eye" id="togglePassword" style="float: right;
                    margin-top: -25px;
                    position: relative;
                    z-index: 2;"></i>
                </div>
                <div class="mb-3 col-md-8">
                    <label>Password Confirmation<span class="text-danger">*</span></label>
                    <input class="form-control" name="password_confirmation" type="password" id="id_password2" >
                    <i class="far fa-eye" id="togglePassword2" style="float: right;
                    margin-top: -25px;
                    position: relative;
                    z-index: 2;"></i>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Register<span class="fas fa-chevron-right ms-1"></span></button>
                    <a href="{{ url('login') }}" class="btn btn-danger">Kembali<span class="fas fa-chevron-right ms-1"></span></a>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password = document.querySelector('#id_password');
        const password2 = document.querySelector('#id_password2');

        togglePassword.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
      });

      togglePassword2.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
          password2.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
      });
      
      </script>
@endsection