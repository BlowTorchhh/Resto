<?php

namespace App\Http\Controllers;

use App\Models\Bahan_baku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanController extends Controller
{
    public function bahan_baku(){
        $data = Bahan_baku::all();
        return view('admin.bahan.bahan', compact('data'));
    }

    public function bahan_baku_addProcess(Request $request){
        $request->validate([
            'nama_bahan'=>'required|unique:bahan_baku',
            'jumlah_stok'=>'required',
        ]);
        
        $bahan = new Bahan_baku([
            'nama_bahan' => $request->nama_bahan,
            'jumlah_stok' => $request->jumlah_stok,
        ]);

        $bahan->save();
        return redirect('bahan_baku');
    }

    public function bahan_baku_editProcess(Request $request, $id){
        $request->validate([
            'nama_bahan'=>'required',
            'jumlah_stok'=>'required',
        ]);
        DB::table('bahan_baku')->where('id',$id)
        ->update([
            'nama_bahan' => $request->nama_bahan,
            'jumlah_stok' => $request->jumlah_stok,
        ]);

        return redirect('bahan_baku')->with('status','Bahan Baku berhasil di edit!');
    }

    public function bahan_baku_delete($id){
        DB::table('bahan_baku')->where('id',$id)
        ->delete();
        return redirect('bahan_baku')->with('status','Bahan Baku Berhasil di Hapus!');
    }
}
