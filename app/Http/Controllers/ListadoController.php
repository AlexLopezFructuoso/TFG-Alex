<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Persona;
use App\Models\Factura;
use App\Models\Deuda;
use App\Models\Pago;

class ListadoController extends Controller
{
    public function index()
    {
        return view('listado.index');
    }

    public function obtenerDatos(Request $request)
    {
        $tipo = $request->tipo;

        switch ($tipo) {
            case 'productos':
                $datos = Producto::all();
                break;
            case 'personas':
                $datos = Persona::all();
                break;
            case 'facturas':
                $datos = Factura::all();        
                break;
            
            case 'deudas':
                $datos = Deuda::all(); 
                break;
            case 'pagos':
                $datos = Pago::all(); 
                break;
            default:
                $datos = collect();
        }

        return response()->json($datos);
    }
}
