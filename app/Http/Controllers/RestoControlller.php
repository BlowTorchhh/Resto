<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resto;
use Intervention\Image\ImageManagerStatic as Image;

class RestoControlller extends Controller
{
    public function resto_addProcess(Request $request){
        $request->validate([
            'nama_resto' => 'required|unique:resto',
            'foto' => 'required',
            'desc' => 'required'
        ]);

        $image = $request->file('foto');
        $imagename = time().'_'.$image->getClientOriginalName();
        // Buat objek Intervention Image dari gambar sumber
        $image = Image::make($image);

        // Resize gambar sesuai kebutuhan
        $width = 1033;
        $height = 763;
        $image->resize($width, $height);
    // Simpan gambar ke dalam direktori penyimpanan
        $image->save(public_path('fotoresto/') . $imagename);

        $resto = new Resto([
            'nama_resto' => $request->nama_resto,
            'foto' => $imagename,
            'desc' => $request->desc,
        ]);

        $resto->save();
        return redirect('admin');
    }
}
