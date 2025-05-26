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
                $datos = Factura::with('persona')->get();
                break;
            //case 'factura_producto':
            //    $datos = Factura_Producto::with(['factura', 'producto'])->get();
            //    break;
            case 'deudas':
                $datos = Deuda::with('persona')->get();
                break;
            case 'pagos':
                $datos = Pago::with(['persona', 'deuda'])->get();
                break;
            default:
                $datos = collect();
        }

        return response()->json($datos);
    }
}
