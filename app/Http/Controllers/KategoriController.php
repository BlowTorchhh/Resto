<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori_menu;

class KategoriController extends Controller
{
    public function kategori_add(){
        $kategori = Kategori_menu::all();
        return view('admin.kategori.kategori', compact('kategori'));
    }

    public function kategori_addProcess(Request $request){
        $request->validate([
            'kategori' => 'required|unique:kategori_menu',
        ]);

        $kategori_menu = new Kategori_menu([
            'kategori' => $request->kategori,
        ]);

        $kategori_menu->save();
        return redirect('kategori');
    }

    public function kategori_editProcess(Request $request ,$id){
        $request->validate([
            'kategori' => 'required',
            'status' => 'required',
        ]);
        DB::table('kategori_menu')->where('id',$id)
        ->update([
            'kategori' => $request->kategori,
            'status' => $request->status,
        ]);
        return redirect('kategori')->with('status', 'Kategori berhasil di ubah!');
    }

    public function kategori_delete($id){
        DB::table('kategori_menu')->where('id',$id)
        ->delete();
        return redirect('kategori')->with('status', 'Kategori berhasil di hapus!');
    }
}
