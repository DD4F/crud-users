<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $response = Http::get('https://restcountries.com/v3.1/region/americas');
        $paises = $response->object();
        foreach ($paises as $pais){
            \App\Models\Countrie::create([
                'nombre'        => $pais->name->common,
            ]);
        }
    }
}
