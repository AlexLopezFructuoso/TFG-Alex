<?php

namespace Database\Seeders;

use App\Models\Deuda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeudaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deuda = new Deuda();

        $deuda->persona_id = 3; // Diana Deudora
        $deuda->monto = 500.00;
        $deuda->descripcion = 'Compra a crédito';
        $deuda->fecha = now();
        
        $deuda->save();
    }
}
