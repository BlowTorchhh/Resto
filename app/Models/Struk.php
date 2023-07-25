<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struk extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primary_key = 'id';
    protected $fillable = ([
        'id',
        'jumlah',
        'subtotal',
        'id_menu',
        'id_reservasi',
    ]);

    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function reservasi(){
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }
}
