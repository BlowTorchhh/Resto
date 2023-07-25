<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $primarykey = 'id';

    protected $fillable = [
        'username',
        'name',
        'email',
        'tanggal_lahir',
        'tempat_lahir',
        'agama',
        'telepon',
        'alamat',
        'jeniskelamin',
        'password',
        'id_role',
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function reservasi(){
        return $this->hasOne(Reservasi::class);
    }
}
