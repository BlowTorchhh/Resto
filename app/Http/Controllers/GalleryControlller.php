<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gallery;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryControlller extends Controller
{
    public function index(){
        $gallery = gallery::all();
        return view('admin.gallery.gallery', compact('gallery'));
    }

public function gallery_addProcess(Request $request)
{
    $request->validate([
        'foto' => 'required',
    ]);

    $image = $request->file('foto');
    $imagename = time().'_'.$image->getClientOriginalName();

    // Buat objek Intervention Image dari gambar sumber
    $image = Image::make($image);

    // Resize gambar sesuai kebutuhan
    $width = 800;
    $height = 600;
    $image->resize($width, $height);

    // Simpan gambar ke dalam direktori penyimpanan
    $image->save(public_path('fotogallery/') . $imagename);

    $gallery = new gallery([
        'foto' => $imagename,
    ]);

    $gallery->save();
    return redirect('gallery')->with('status', 'Gallery berhasil di tambah!');
}
public function gallery_editProcess(Request $request ,$id){
    $request->validate([
        'foto'=>'required',
    ]);

    $edit = Gallery::findorfail($id);
    $image = public_path('/fotogallery/').$edit->foto;

    if (file_exists($image)) {
        @unlink($image);
    }

    $image = $request->file('foto');
    $imagename = time().'_'.$image->getClientOriginalName();
    // Buat objek Intervention Image dari gambar sumber
    $image = Image::make($image);

    // Resize gambar sesuai kebutuhan
    $width = 800;
    $height = 600;
    $image->resize($width, $height);
    // Simpan gambar ke dalam direktori penyimpanan
    $image->save(public_path('fotogallery/') . $imagename);

    $edit
    ->update([
        'foto' => $imagename,
    ]);
    return redirect('gallery')->with('status', 'Gallery berhasil di ubah!');
}
public function gallery_delete($id){
    $hapus = Gallery::findorfail($id);

    $image = public_path('/fotogallery/').$hapus->foto;

    if (file_exists($image)) {
        @unlink($image);
    }

    $hapus->delete();
    return redirect('gallery')->with('status', 'Gallery berhasil di hapus!');
}
    
}
