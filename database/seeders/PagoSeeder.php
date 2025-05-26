<?php

namespace Database\Seeders;

use App\Models\Pago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pago = new Pago();
        
        $pago->persona_id = 3; // Diana Deudora
        $pago->deuda_id = 1;
        $pago->fecha = now();
        $pago->monto = 200.00;
        $pago->metodo_pago = 'efectivo';
        $pago->descripcion = 'Primer abono';

        $pago->save();
    }
}
