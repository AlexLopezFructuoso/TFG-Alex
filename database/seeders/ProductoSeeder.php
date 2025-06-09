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
        $producto->tipo = 'venta';

        $producto->save();

        $producto = new Producto();

        $producto->nombre = 'Altavoz JBL';
        $producto->descripcion = '';
        $producto->cantidad = 45;
        $producto->precio = 87;
        $producto->tipo = 'venta';

        $producto->save();

        
        $producto = new Producto();

        $producto->nombre = 'Movil Samsung S24 ULTRA';
        $producto->descripcion = '128GB';
        $producto->cantidad = 20;
        $producto->precio = 850;
        $producto->tipo = 'venta';

        $producto->save();
    }
}
