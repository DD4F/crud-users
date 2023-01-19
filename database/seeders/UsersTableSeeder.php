<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\User::create([
            'identificacion'=> '1000000001',
            'nombres'       => 'Admin',
            'Apellidos'     => 'Users',
            'celular'       => '3232323232',
            'direccion'     => 'Kr 33 #3-12',
            'email'         => 'admin.users@app.com',
            'categoria_id'  => '1',
            'countrie_id'   => '28',
            'password'      => bcrypt('adminusers'),
        ]);
    }
}
