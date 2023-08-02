<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Kategori_menu;
use App\Models\Resep;

class MenuController extends Controller
{
    public function menu_add(){
        $data = Kategori_menu::all();
        $menu = Menu::with('Kategori_Menu')->get();
        return view('admin.menu.menu',compact('data'),['menu'=>$menu]);
    }

    public function menu_addProcess(Request $request){
        $request->validate([
            'nama_menu' => 'required|unique:menu',
            'harga' => 'required',
            'id_kategori' => 'required',
            'kategori_halal' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $imagename = time().'_'.$image->getClientOriginalName();
        $image->move('fotomenu/', $imagename);

        $menu = new Menu([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'id_kategori' => $request->id_kategori,
            'kategori_halal' => $request->kategori_halal,
            'foto' => $imagename,
        ]);
        
        $menu->save();
        return redirect('menu');
    }

    public function menu_editProcess(Request $request ,$id){
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'kategori_halal' => 'required',
            'image2' => 'required',
        ]);

        $edit = Menu::findorfail($id);
        $image = public_path('/fotomenu/').$edit->foto;

        if (file_exists($image)) {
            @unlink($image);
        }

        $image2 = $request->file('image2');
        $imagename = time().'_'.$image2->getClientOriginalName();
        $image2->move('fotomenu/', $imagename);

        $edit
        ->update([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'status' => $request->status,
            'kategori_halal' => $request->kategori_halal,
            'foto' => $imagename,
        ]);
        return redirect('menu')->with('status', 'Menu berhasil di ubah!');
    }

    public function menu_delete($id){
        $hapus = Menu::findorfail($id);

        $image = public_path('/fotomenu/').$hapus->foto;

        if (file_exists($image)) {
            @unlink($image);
        }

        $hapus->delete();
        return redirect('menu')->with('status', 'Menu berhasil di hapus!');
    }

    
}
