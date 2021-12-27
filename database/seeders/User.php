<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@toko.com',
            'address' => 'Jl. Ir. H. Juanda No.8 Bandung',
            'contact' => '021-233-21',
            'password' => Hash::make('admin123') 
        ]);
    }
}
