<?php

namespace App\Http\Controllers;

use App\Models\Bahan_baku;
use App\Models\Menu;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ResepController extends Controller
{
    public function resep(){
        $menu = Menu::all();
        $bahan = Bahan_baku::all();
        $data = Resep::with('menu','bahan_baku')->get();
        return view('admin.resep.resep', compact('menu','bahan'), ['data'=>$data]);
    }

    public function resep_addProcess(Request $request){
        $request->validate([
            'menu'=>'required',
            'bahan'=>'required',
            'takaran'=>'required',
        ]);

        $resep = new Resep([
            'id_menu' => $request->menu,
            'id_bahan' => $request->bahan,
            'takaran' => $request->takaran,
        ]);

        $resep->save();

        return redirect('resep')->with('status','Resep Barhasil ditambah');
    }

    public function resep_editProcess(Request $request, $id){
        $request->validate([
            'takaran'=>'required',
        ]);
        DB::table('resep')->where('id',$id)
        ->update([
            'takaran'=>$request->takaran
        ]);

        return redirect('resep')->with('status', 'Resep Berhasil diedit!');
    }

    public function resep_delete($id){
        Db::table('resep')->where('id',$id)
        ->delete();
        return redirect('resep')->with('status', 'Resep Berhasil Dihapus!');
    }

    public function detail($id){
        $data = Resep::with('menu','bahan_baku')->where('id_menu',$id)->get();
        $count = $data->count();
        if($count<=0){
            $menu = Menu::where('id',$id)->first();
            return view('admin.resep.detail', compact('count','menu'));
        }
        return view('admin.resep.detail', compact('data','count'));
    }
}
