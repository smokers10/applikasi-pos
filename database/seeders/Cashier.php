<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Cashier extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [  'name' => 'cashier01',
                'email' => 'cashier01@toko.com',
                'address' => 'Jl. Ir. H. Juanda No.8 Bandung',
                'contact' => '021-233-21',
                'role' => 'cashier',
                'password' => Hash::make('cashier123')],
            [  'name' => 'cashier02',
                'email' => 'cashier02@toko.com',
                'address' => 'Jl. Ir. H. Juanda No.8 Bandung',
                'contact' => '021-233-21',
                'role' => 'cashier',
                'password' => Hash::make('cashier123')],
        ];
        DB::table('users')->insert($user);
    }
}
