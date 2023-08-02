<?php

namespace App\Http\Controllers;

use App\Models\Kategori_menu;
use App\Models\Menu;
use App\Models\Reservasi;
use App\Models\Resto;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Struk;

class AdminController extends Controller
{
    public function index(){
        $data = Role::all();
        $kategori = Kategori_menu::all();
        $menu = Menu::with('Kategori_Menu')->get();
        $reservasi = Reservasi::with('user')->where('tanggal', date('Y-m-d'))->get();
        $resto = Resto::all();
        $struks = array();
            foreach ($reservasi as $item) {
                $id_reservasi = $item->id;
                $struk = Struk::with('menu','reservasi')->where('id_reservasi', $id_reservasi)->get();
                $struk2 = $struk->groupBy('id_reservasi');
                $struks[] = $struk2;
            }
        return view('admin.index', compact('data','kategori','struks','resto'),['menu'=>$menu, 'reservasi'=>$reservasi]);
    }

    public function role_add(){
        $data = Role::all();
        return view('admin.role', compact('data'));
    }

    public function role_addProcess(Request $request){
        $request->validate([
            'role' => 'required|unique:role',
        ]);

        $role = new Role([
            'role' => $request->role,
        ]);

        $role->save();
        return redirect('admin');
    }

    public function role_editProcess(Request $request , $id){
        $request->validate([
            'role' => 'required',
            'status' => 'required',
        ]);
        DB::table('role')->where('id',$id)
        ->update([
            'role' => $request->role,
            'status' => $request->status,
        ]);
        return redirect('admin')->with('status', 'Role berhasil di ubah!');
    }

    public function role_delete(Request $request ,$id){
        DB::table('role')->where('id',$id)
        ->delete();
        return redirect('admin')->with('status', 'Role berhasil di hapus!');
    }

}
