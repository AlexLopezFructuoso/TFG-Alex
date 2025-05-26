<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $producto = new Producto();

        $producto->nombre = 'Laptop HP';
        $producto->descripcion = '14 pulgadas';
        $producto->cantidad = 10;
        $producto->precio = 800.00;
        $producto->tipo = 'uso_interno';

        $producto->save();

        $producto = new Producto();

        $producto->nombre = 'Mesas de noche';
        $producto->descripcion = '2 metros';
        $producto->cantidad = 45;
        $producto->precio = 87;
        $producto->tipo = 'venta';

        $producto->save();
    }
}
