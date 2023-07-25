<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekening;
use Illuminate\Support\Facades\DB;

class RekeningController extends Controller
{
    public function index(){
        $data = Rekening::all();
        return view('admin.rekening.rekening', compact('data'));
    }

    public function rekening_addProcess(Request $request){
        $request->validate([
            'bank' => 'required',
            'nama_rekening' => 'required',
            'no_rekening' => 'required',
        ]);

        $rekening = new Rekening([
            'bank' => $request->bank,
            'nama' => $request->nama_rekening,
            'no_rekening' => $request->no_rekening,
        ]);

        $rekening->save();
        return redirect('rekening');
    }

    public function rekening_editProcess(Request $request ,$id){
        $request->validate([
            'bank' => 'required',
            'nama_rekening' => 'required',
            'no_rekening' => 'required',
            'status' => 'required',
        ]);
        DB::table('rekening')->where('id',$id)
        ->update([
            'bank' => $request->bank,
            'nama' => $request->nama_rekening,
            'no_rekening' => $request->no_rekening,
            'status' => $request->status,
        ]);
        return redirect('rekening')->with('status', 'Rekening berhasil di ubah!');
    }

    public function rekening_delete($id){
        DB::table('rekening')->where('id',$id)
        ->delete();
        return redirect('rekening')->with('status', 'Rekening berhasil di hapus!');
    }
}
