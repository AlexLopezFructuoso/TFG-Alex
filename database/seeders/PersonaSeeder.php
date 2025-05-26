<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persona = new Persona();

        $persona->nombre = 'Carlos Cliente';
        $persona->tipo = 'cliente';
        $persona->telefono = '123456789';
        $persona->direccion = 'Calle 1';

        $persona->save();

        $persona = new Persona();

        $persona->nombre = 'Pedro Proveedor';
        $persona->tipo = 'proveedor';
        $persona->telefono = '987654321';
        $persona->direccion = 'Calle 2';
        
        $persona->save();

        $persona = new Persona();

        $persona->nombre = 'Diana Deudora';
        $persona->tipo = 'deudor';
        $persona->telefono = '111222333';
        $persona->direccion = 'Calle 3';
        
        $persona->save();
    }
}
