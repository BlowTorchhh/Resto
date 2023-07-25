<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login()
    {
        $data['title'] = 'login';
        return view('user.login',$data);
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $request->session()->regenerate();
            if (Auth::user()->id_role == 1) {
                return redirect('admin');
            }
            if (Auth::user()->id_role == 2) {
                return redirect('pegawai');
            }
            if (Auth::user()->id_role == 3) {
                return redirect('/');
            }
        }
        return back()->with('error','Username atau Password salah!');
    }

    public function register()
    {
        $data['title'] = 'register';
        return view('user.register',$data);
    }

    public function registerAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'jeniskelamin' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = new User([
            'name' => $request->name,
            'role' => 'customer',
            'username' => $request->username,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'jeniskelamin' => $request->jeniskelamin,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        return redirect('login')->with('status','Registasi berhasil. Silahkan login!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
