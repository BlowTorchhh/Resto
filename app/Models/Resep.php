<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $table = 'resep';
    protected $primary_key = 'id';
    protected $fillable = ([
        'id',
        'id_menu',
        'id_bahan',
        'takaran',
    ]);

    public function menu(){
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    public function bahan_baku(){
        return $this->belongsTo(Bahan_baku::class, 'id_bahan');
    }
}
