<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $table = 'reservasi';
    protected $primary_key = 'id';
    protected $fillable = ([
        'id',
        'code',
        'nomor_meja',
        'nama',
        'id_customer',
        'jam_booking',
        'tanggal',
        'id_rekening',
        'status',
    ]);

    public function user(){
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function rekening(){
        return $this->belongsTo(Rekening::class, 'id_rekening');
    }

    public function struk(){
        return $this->hasOne(Struk::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            while (true) {
                $code = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1)) . str_pad(rand(0, 999), 4, "0", STR_PAD_LEFT);
                if (!static::whereCode($code)->exists()) {
                    $model->code = $code;
                    return;
                }
            }
        });
    }
}
