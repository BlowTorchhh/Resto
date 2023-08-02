<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\chef;
use App\Models\gallery;
use App\Models\Kategori_menu;
use App\Models\Role;
use App\Models\User;
use App\Models\Menu;
use App\Models\Nomor_Meja;
use App\Models\Rekening;
use App\Models\Resto;
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

        Kategori_menu::Create([
            'kategori' => 'Makanan',
            'status' => 'aktif',
        ]);

        Kategori_menu::Create([
            'kategori' => 'Minuman',
            'status' => 'aktif',
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

       User::Create([
        'username' => 'a',
        'name' => 'Hanif',
        'email' => 'a@mail.com',
        'tanggal_lahir' => '2000-9-18',
        'tempat_lahir' => 'Bandung',
        'agama' => 'Islam',
        'telepon' => '08123456789',
        'alamat' => 'Jl. Coba',
        'jeniskelamin' => 'Laki-laki',
        'password' => Hash::make('a'),
        'id_role' => '3',
       ]);

       Menu::Create([
        'nama_menu'=> 'Ayam Goreng',
        'harga'=> '10000',
        'id_kategori'=> '1',
        'status'=> 'Tersedia',
        'kategori_halal'=> 'Halal',
        'foto' => '1690861637_ayam.jfif',
        'desc' => 'Gurih Nikmat Lezat',
       ]);

       Menu::Create([
        'nama_menu'=> 'Air Putih',
        'harga'=> '5000',
        'id_kategori'=> '2',
        'status'=> 'Tersedia',
        'kategori_halal'=> 'Halal',
        'foto' => 'air.jpg',
        'desc' => 'Sehat Menyegarkan',
       ]);

       Rekening::Create([
        'bank' => 'bjb',
        'nama' => 'Asep Setiawan',
        'no_rekening' => '123123123123',
        'status' => 'Aktif',
       ]);

       Gallery::Create([
        'foto' => 'gallery-1.jpg',
       ]);

       Gallery::Create([
        'foto' => 'gallery-2.jpg',
       ]);

       Gallery::Create([
        'foto' => 'gallery-3.jpg',
       ]);

       Gallery::Create([
        'foto' => 'gallery-4.jpg',
       ]);

       Gallery::Create([
        'foto' => 'gallery-5.jpg',
       ]);

       Gallery::Create([
        'foto' => 'gallery-6.jpg',
       ]);

       Gallery::Create([
        'foto' => 'gallery-7.jpg',
       ]);

       Gallery::Create([
        'foto' => 'gallery-8.jpg',
       ]);

       Resto::Create([
        'nama_resto' => 'Restaurant',
        'foto' => 'about.jpg',
        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua.
        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
        culpa qui officia deserunt mollit anim id est laborum',
       ]);

       Chef::Create([
        'nama_chef' => 'Walter White',
        'bagian' => 'Chef Utama',
        'foto' => 'chefs-1.jpg',
       ]);
       Chef::Create([
        'nama_chef' => 'Jessica',
        'bagian' => 'Pelayan',
        'foto' => 'chefs-2.jpg',
       ]);
       Chef::Create([
        'nama_chef' => 'Jesse Pinkman',
        'bagian' => 'Juru Masak',
        'foto' => 'chefs-3.jpg',
       ]);
       Nomor_Meja::Create([
        'nomor_meja' => '1',
        'status' => 'Kosong'
       ]);
       Nomor_Meja::Create([
        'nomor_meja' => '2',
        'status' => 'Kosong'
       ]);
       Nomor_Meja::Create([
        'nomor_meja' => '3',
        'status' => 'Kosong'
       ]);
    }
}
