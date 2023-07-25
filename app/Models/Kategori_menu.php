<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_menu extends Model
{
    use HasFactory;
    protected $table = 'kategori_menu';
    protected $primary_key = 'id';
    protected $fillable = [
        'id',
        'kategori',
        'status',
    ];

    public function menu(){
        return $this->hasOne(Menu::class);
    }
}
