<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\chef;
use Intervention\Image\ImageManagerStatic as Image;

class ChefControlller extends Controller
{
    public function index(){
        $chef = chef::all();
        return view('admin.chef.chef', compact('chef'));
    }

    public function chef_addProcess(Request $request){
        $request->validate([
            'nama_chef' => 'required',
            'bagian' => 'required',
            'foto' => 'required',
        ]);

        $image = $request->file('foto');
        $imagename = time().'_'.$image->getClientOriginalName();
        // Buat objek Intervention Image dari gambar sumber
        $image = Image::make($image);

        // Resize gambar sesuai kebutuhan
        $width = 600;
        $height = 600;
        $image->resize($width, $height);

        // Simpan gambar ke dalam direktori penyimpanan
        $image->save(public_path('fotochef/') . $imagename);

        $chef = new chef([
            'nama_chef' => $request->nama_chef,
            'bagian' => $request->bagian,
            'foto' => $imagename,
        ]);

        $chef->save();
        return redirect('chef');
    }
    public function chef_editProcess(Request $request ,$id){
        $request->validate([
            'nama_chef' => 'required',
            'bagian' => 'required',
            'foto'=>'required',
        ]);
    
        $edit = Chef::findorfail($id);
        $image = public_path('/fotochef/').$edit->foto;
    
        if (file_exists($image)) {
            @unlink($image);
        }
    
        $image = $request->file('foto');
        $imagename = time().'_'.$image->getClientOriginalName();
        // Buat objek Intervention Image dari gambar sumber
        $image = Image::make($image);
    
        // Resize gambar sesuai kebutuhan
        $width = 600;
        $height = 600;
        $image->resize($width, $height);
        // Simpan gambar ke dalam direktori penyimpanan
        $image->save(public_path('fotochef/') . $imagename);
    
        $edit
        ->update([
            'nama_chef' => $request->nama_chef,
            'bagian' => $request->bagian,
            'foto' => $imagename,
        ]);
        return redirect('chef')->with('status', 'Chef berhasil di ubah!');
    }
    public function chef_delete($id){
        $hapus = Chef::findorfail($id);
    
        $image = public_path('/fotochef/').$hapus->foto;
    
        if (file_exists($image)) {
            @unlink($image);
        }
    
        $hapus->delete();
        return redirect('chef')->with('status', 'Chef berhasil di hapus!');
    }
}
