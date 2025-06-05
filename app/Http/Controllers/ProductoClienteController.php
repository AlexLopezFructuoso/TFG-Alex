<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoClienteController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los productos para el select
        $productos = DB::table('productos')->select('id', 'nombre')->get();

        $resultados = null;
        $productoId = $request->input('producto_id');

        if ($productoId) {
            $sql = "
                SELECT personas.nombre AS cliente, SUM(factura_producto.cantidad) AS cantidad
                FROM personas
                JOIN facturas ON personas.id = facturas.persona_id
                JOIN factura_producto ON facturas.id = factura_producto.factura_id
                JOIN productos ON factura_producto.producto_id = productos.id
                WHERE productos.id = ?
                AND personas.tipo = 'cliente'
                GROUP BY personas.nombre
            ";

            $resultados = DB::select($sql, [$productoId]);
        }

        return view('producto_cliente.index', compact('productos', 'resultados', 'productoId'));
    }
}
