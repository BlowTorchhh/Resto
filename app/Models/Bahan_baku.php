<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan_baku extends Model
{
    use HasFactory;
    protected $table = 'bahan_baku';
    protected $primary_key = 'id';
    protected $fillable = ([
        'id',
        'nama_bahan',
        'jumlah_stok',
    ]);

    public function resep(){
        return $this->hasOne(Resep::class);
    }
}
