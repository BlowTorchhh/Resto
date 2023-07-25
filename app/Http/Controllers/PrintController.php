<?php

namespace App\Http\Controllers;

use App\Models\Struk;
use App\Models\Menu;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printTable($id)
    {
        $reservasi = Reservasi::with('user')->where('code', $id)->first();
        $data = Struk::with('menu','reservasi')->where('id_reservasi',$reservasi->id)->get();

        return view('print.print_table',compact('reservasi','data'));
    }
} 
