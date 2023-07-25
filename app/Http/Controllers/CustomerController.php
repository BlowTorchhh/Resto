<?php

namespace App\Http\Controllers;

use App\Models\Nomor_Meja;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(){
        return redirect('/');
    }

    public function reservasi(){
        $reservasi = Reservasi::with('user')->where('id_customer', Auth::user()->id)->get();
        return view('customer.reservasi',compact('reservasi'));
    }

    public function reservasi_editProcess(Request $request, $id){
        $request->validate([
            'jam_booking' => 'required',
        ]);

        DB::table('reservasi')->where('id',$id)
        ->update([
            'jam_booking' => $request->jam_booking,
        ]);

        return redirect('/')->with('status', 'Reservasi Berhasil diedit!');
    }

    public function reservasi_delete($id){

        $reservasi = Reservasi::where('id',$id)->first();
        $data = $reservasi->nomor_meja;
        
        DB::table('nomor_meja')->where('nomor_meja',$data)
        ->update([
            'status'=>'Kosong',
        ]);

        DB::table('reservasi')->where('id',$id)
        ->delete();
        return redirect('/')->with('status', 'Reservasi Berhasil Dihapus!');
    }
}
