<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $primary_key = 'id';
    protected $fillable = [
        'id',
        'nama_menu',
        'harga',
        'id_kategori',
        'status',
        'kategori_halal',
        'foto',
        'desc',
    ];

    public function Kategori_Menu(){
        return $this->belongsTo(kategori_menu::class, 'id_kategori');
    }

    public function resep(){
        return $this->hasOne(Resep::class);
    }

    public function struk(){
        return $this->hasMany(Struk::class);
    }
}
