<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomor_Meja extends Model
{
    use HasFactory;

    protected $table = 'nomor_meja';
    protected $primary = 'id';
    protected $fillable = ([
        'id',
        'nomor_meja',
        'status',
    ]);
}
