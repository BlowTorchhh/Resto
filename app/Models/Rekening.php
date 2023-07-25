<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $table = 'rekening';
    protected $primary_key = 'id';
    protected $fillable = ([
        'id',
        'bank',
        'nama',
        'no_rekening',
        'status',
    ]);

    public function reservasi(){
        return $this->hasOne(Reservasi::class);
    }
}
