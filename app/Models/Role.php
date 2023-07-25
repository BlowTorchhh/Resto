<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $primary_key = 'id';
    protected $fillable =[
        'role',
        'status',
    ];

    public function user(){
        return $this->hasOne(User::class);
    }
}
