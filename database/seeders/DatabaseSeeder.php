<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::Create([
            'role'=> 'admin',
            'status' => 'Aktif',
        ]);

        Role::Create([
            'role'=> 'pegawai',
            'status' => 'Aktif',
        ]);

        Role::Create([
            'role'=> 'customer',
            'status' => 'Aktif',
        ]);

       User::Create([
        'username' => 'admin123',
        'name' => 'Ujang',
        'email' => 'admin@gmail.com',
        'tanggal_lahir' => '2000-9-18',
        'tempat_lahir' => 'Bandung',
        'agama' => 'Islam',
        'telepon' => '08123456789',
        'alamat' => 'Jl. Coba-coba',
        'jeniskelamin' => 'Laki-laki',
        'password' => Hash::make('123asdqwe'),
        'id_role' => '1',
       ]);
    }
}
