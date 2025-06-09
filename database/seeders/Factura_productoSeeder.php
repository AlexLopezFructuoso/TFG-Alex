<?php

namespace Database\Seeders;

use App\Models\Factura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Factura_productoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factura = Factura::find(1);

        
        $factura->productos()->attach([
            1 => ['cantidad' => 1
        ], 
            2 => ['cantidad' => 2
        ],  
        ]);
    }
}
