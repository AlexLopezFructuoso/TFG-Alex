<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;

class FacturasPersonasController extends Controller
{
    public function personasFacturas(Request $request)
    {
        $personaId = $request->input('persona_id');
        $personas = Persona::all();
        $facturas = [];
        if ($personaId) {
            $facturas = DB::select(
                'SELECT f.id, f.fecha, f.tipo, p.nombre as producto_nombre, fp.cantidad
                 FROM facturas f
                 LEFT JOIN factura_producto fp ON f.id = fp.factura_id
                 LEFT JOIN productos p ON fp.producto_id = p.id
                 WHERE f.persona_id = ?',
                [$personaId]
            );
        }
        return view('facturas.personas_facturas', compact('personas', 'facturas', 'personaId'));
    }
}
