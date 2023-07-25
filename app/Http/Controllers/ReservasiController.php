<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{

    public function reservasi_editProcess(Request $request ,$id){
        $request->validate([
            'nomor_meja' => 'required',
            'jam_booking' => 'required',
            'status' => 'required',
        ]);
        DB::table('reservasi')->where('id',$id)
        ->update([
            'nomor_meja' => $request->nomor_meja,
            'jam_booking' => $request->jam_booking,
            'status' => $request->status,
        ]);
        return redirect('admin')->with('status', 'Reservasi berhasil di ubah!');
    }

}
