<?php

namespace Database\Seeders;

use App\Models\Factura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factura = new Factura();

        $factura->persona_id = 1; // Carlos Cliente
        $factura->fecha = now();
        $factura->tipo = 'venta';
        $factura->total = 820.00;
        
        $factura->save();
    }
}
