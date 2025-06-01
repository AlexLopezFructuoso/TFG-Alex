<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Persona;
use App\Models\Producto;

class BuscarController extends Controller
{
    public function index()
    {
        return view('buscar');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Buscar en campos específicos de Factura
        $facturas = Factura::where('id', 'like', "%{$query}%")
            ->orWhere('tipo', 'like', "%{$query}%")
            ->orWhere('fecha', 'like', "%{$query}%")
            ->orWhere('persona_id', 'like', "%{$query}%")
            ->get();

        // Buscar en campos específicos de Persona
        $personas = Persona::where('id', 'like', "%{$query}%")
            ->orWhere('nombre', 'like', "%{$query}%")
            ->orWhere('telefono', 'like', "%{$query}%")
            ->orWhere('direccion', 'like', "%{$query}%")
            ->get();

        // Buscar en campos específicos de Producto
        $productos = Producto::where('id', 'like', "%{$query}%")
            ->orWhere('nombre', 'like', "%{$query}%")
            ->orWhere('precio', 'like', "%{$query}%")
            ->orWhere('cantidad', 'like', "%{$query}%")
            ->get();

        return view('buscar', compact('facturas', 'personas', 'productos', 'query'));
    }

    public function personasFacturas(Request $request)
    {
        $personaId = $request->input('persona_id');
        $personas = Persona::all();

        if ($personaId) {
            $facturas = Factura::with(['productos'])->where('persona_id', $personaId)->get();
            return view('facturas.personas_facturas', compact('personas', 'facturas', 'personaId'));
        }

        return view('facturas.personas_facturas', compact('personas'));
    }

    
}
