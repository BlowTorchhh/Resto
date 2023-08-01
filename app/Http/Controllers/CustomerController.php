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
            'nomor_meja' => 'required',
            'jam_booking' => 'required',
        ]);
        if($request->nama == null){
            $nama = null;
        }
        else{
            $nama = $request->nama;
        }
        $find_meja = DB::table('reservasi')->where('id',$id)->get('nomor_meja');

        $meja = DB::table('nomor_meja')->where('nomor_meja',$find_meja->value('nomor_meja'))
        ->update([
            'status' => 'Kosong',
        ]);

        DB::table('reservasi')->where('id',$id)
        ->update([
            'nama' => $nama,
            'nomor_meja' => $request->nomor_meja,
            'jam_booking' => $request->jam_booking,
        ]);

        DB::table('nomor_meja')->where('nomor_meja',$request->nomor_meja)
        ->update([
            'status'=>'Di-Booking',
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
