<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menambahkan user Administrator
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081288954050',
            'password' => bcrypt('password'),
        ]);

        // Menambahkan user Muhammad Irsyad
        User::create([
            'nama' => 'Muhammad Irsyad',
            'email' => 'irsyadmuhammad4321@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '089654619089',
            'password' => bcrypt('password'),
        ]);

        // Menambahkan data kategori
        Kategori::create(['nama_kategori' => 'Brownies']);
        Kategori::create(['nama_kategori' => 'Combro']);
        Kategori::create(['nama_kategori' => 'Dawet']);
        Kategori::create(['nama_kategori' => 'Mochi']);
        Kategori::create(['nama_kategori' => 'Wingko']);
    }
}