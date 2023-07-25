<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use App\Models\Struk;

class StrukController extends Controller
{
    public function reservasi_addProcess(Request $request){

        $count = DB::table('nomor_meja')->where('status','Kosong')->count();
        $tanggal = date('Y-m-d');

        if($count<=0){
            return redirect('/')->with('error', 'Meja Penuh!');
        }
        if($count>=1){
            $firstValue = DB::table('nomor_meja')
            ->select(DB::raw('(nomor_meja) as array_values'))
            ->where('status','Kosong')
            ->first()
            ->array_values[0];

        $request->validate([
            'jam_booking' => 'required',
            'bank' => 'required',
        ]);

        $reservasi = new Reservasi([
            'nomor_meja' => $firstValue,
            'id_customer' => Auth::user()->id,
            'jam_booking' => $request->jam_booking,
            'tanggal' => $tanggal,
            'id_rekening' => $request->bank,
        ]);

        $reservasi->save();

        DB::table('nomor_meja')->where('nomor_meja',$firstValue)
        ->update([
            'status'=>'Di-Booking',
        ]);
        
        $id_reservasi = $reservasi->id;
        $cart = session("cart");

        foreach ($cart as $ct=>$item){
            $struk = new Struk([
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal'],
                'id_menu' => $ct,
                'id_reservasi' => $id_reservasi,
            ]);
            $struk->save();
        }
        session()->forget("cart");
        return redirect()->back()->with('status', 'Reservasi Berhasil ditambah!');
        }
        
    }
    
}
