<?php

namespace App\Http\Controllers;

use App\Models\chef;
use App\Models\gallery;
use App\Models\Kategori_menu;
use App\Models\Menu;
use App\Models\Nomor_Meja;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservasi;
use App\Models\Resto;
use App\Models\Struk;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $menu = Menu::all();
        $countresto = Resto::all();
        $resto = DB::table('resto')->first();
        $chef = Chef::all();
        $gallery = Gallery::all();
        $kategori = Kategori_menu::all();
    if(Auth::user()){
        if(Auth::user()->id_role==3){
            $reservasi = Reservasi::with('user')->where('id_customer', Auth::user()->id)->where('tanggal', date('Y-m-d'))->get();
            $rekening = Rekening::all();
            $meja = Nomor_Meja::where('status','Kosong')->get();
            
            $struks = array();
            foreach ($reservasi as $item) {
                $id_reservasi = $item->id;
                $struk = Struk::with('menu','reservasi')->where('id_reservasi', $id_reservasi)->get();
                $struk2 = $struk->groupBy('id_reservasi');
                $struks[] = $struk2;
                
            }
            // return dd($reservasi);
            if (session('cart')) {
                $cart = session()->get('cart');
                // return dd($cart);
                return view('index',compact('reservasi','menu','cart','rekening','struks','meja','resto','chef','gallery','kategori','countresto'));
            }
            return view('index',compact('reservasi','menu','rekening','struks','meja','resto','chef','gallery','kategori','countresto'));
        }
    }
        return view('index',compact('menu','resto','chef','gallery','kategori','countresto'));
    }

    public function addToCart(Request $request, $id){
        $cart = session("cart");
        $jumlah = $request->jumlah;
        $menu = Menu::findorfail($id);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['jumlah'] += $jumlah;
            session(["cart" => $cart]);
            $subtotal = $cart[$menu->id]['jumlah'] * $menu->harga;
            $cart[$menu->id]['subtotal'] = $subtotal;
            session(["cart" => $cart]);

            return redirect()->back()->with('success', 'Jumlah '.$menu->nama_menu.' Berhasil Ditambah ke keranjang!');
        }
        
            $subtotal = $jumlah * $menu->harga;
            $cart[$menu->id] = [
                'nama_menu' => $menu->nama_menu,
                'jumlah' => $jumlah,
                'harga' => $menu->harga,
                'subtotal' => $subtotal,
            ];
    
            session(["cart" => $cart]);
    
            return redirect()->back()->with('success', $menu->nama_menu.' Berhasil Dimasukkan ke keranjang!');
        
    }

    public function deleteCart($id){
        $cart = session("cart");
        $menu = Menu::findorfail($id);
        unset($cart[$id]);
        session(["cart" => $cart]);
        return redirect()->back()->with('success', $menu->nama_menu.'Berhasil Dihapus Dari Keranjang!');
    }

    public function deleteAllCart(){
        session()->forget("cart");
        return redirect()->back()->with('success', 'Semua Data Keranjang Berhasil Dihapus!');
    }

}
