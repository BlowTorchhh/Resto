<?php

namespace App\Http\Controllers;

use App\Models\Nomor_Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MejaController extends Controller
{
    public function index(){
        $data = Nomor_Meja::all();
        return view('admin.meja.meja', compact('data'));
    }

    public function meja_addProcess(Request $request){
        $request->validate([
            'nomor_meja'=>'required|unique:nomor_meja',
        ]);

        $meja = new Nomor_Meja([
            'nomor_meja'=>$request->nomor_meja,
        ]);

        $meja->save();

        return redirect('meja');
    }

    public function meja_editProcess(Request $request, $id){
        $request->validate([
            'nomor_meja'=>'required',
            'status'=>'required',
        ]);

        DB::table('nomor_meja')->where('id',$id)
        ->update([
            'nomor_meja'=>$request->nomor_meja,
            'status'=>$request->status,
        ]);

        return redirect('meja');
    }

    public function meja_delete($id){
        $meja = DB::table('nomor_meja')->where('id',$id)->first();

        if ($meja->status === 'Kosong') {
            DB::table('nomor_meja')->where('id',$id)
            ->delete();

            return redirect('meja')->with('status','Meja Berhasil dihapus!');
        }
        elseif ($meja->status == 'Di-Isi') {
            return redirect('meja')->with('error','Meja yang Di-Isi tidak dapat dihapus dihapus!');
        }
        else {
            return redirect('meja')->with('error', 'Meja yang Di-Booking Tidak bisa dihapus!');
        }

        
    }
}
