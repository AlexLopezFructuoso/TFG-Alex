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

        // Attach productos a la factura con datos adicionales
        $factura->productos()->attach([
            1 => ['cantidad' => 1//, 'precio_unitario' => 800.00
        ], // Laptop HP
            2 => ['cantidad' => 2//, 'precio_unitario' => 10.00
        ],  // Cable HDMI
        ]);
    }
}
