<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categorias = ['Administrador', 'Cliente', 'Proveedor', 'Funcionario Interno'];
        foreach ($categorias as $categoria){
            \App\Models\Categoria::create([
                'nombre'        => $categoria,
                'descripcion'   => $categoria,
            ]);
        }
    }
}
