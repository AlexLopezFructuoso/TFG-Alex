<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Models\Persona;
use App\Models\Producto;
use Illuminate\Http\Request;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Seller;

class VentaFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::with('productos', 'persona') 
            ->where('tipo', 'venta')
            ->get();

        return view('facturas.facturas', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();

        $persona = Persona::all();

        return view('facturas.crearFacturas', compact('productos', 'persona'));    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->all();
    $data['tipo'] = 'venta';

    // Validar que se seleccione un cliente
    if (empty($data['customer_id'])) {
        return redirect()->back()->withErrors(['customer_id' => 'Debe seleccionar un cliente'])->withInput();
    }

    $productos = $request->input('products', []);
    $quantities = $request->input('quantities', []);

    // Validar que se seleccione al menos un producto
    if (empty($productos) || count(array_filter($productos)) == 0) {
        return redirect()->back()->withErrors(['products' => 'Debe seleccionar al menos un producto'])->withInput();
    }

    // Validar stock mínimo para cada producto
    $stock_minimo = 5; // Ejemplo, puede ser configurado en otro lugar
    for ($i = 0; $i < count($productos); $i++) {
        if ($productos[$i] != '') {
            $producto = Producto::find($productos[$i]);
            if ($producto) {
                $cantidad = $quantities[$i];
                if ($producto->cantidad - $cantidad < $stock_minimo) {
                    return redirect()->back()->withErrors(['stock' => "No hay stock suficiente para el producto {$producto->nombre}"])->withInput();
                }
            }
        }
    }

    // Mapear customer_id a persona_id para la base de datos
    if (isset($data['customer_id'])) {
        $data['persona_id'] = $data['customer_id'];
        unset($data['customer_id']);
    }

    // Asignar fecha actual si no está definida
    if (!isset($data['fecha']) || empty($data['fecha'])) {
        $data['fecha'] = date('Y-m-d');
    }

    // Crear la factura solo si todas las validaciones pasaron
    $factura = Factura::create($data);

    $total = 0;
    for ($i = 0; $i < count($productos); $i++) {
        if ($productos[$i] != '') {
            $producto = Producto::find($productos[$i]);
            if ($producto) {
                $cantidad = $quantities[$i];
                $total += $producto->precio * $cantidad;
                $factura->productos()->attach($producto->id, ['cantidad' => $cantidad]);
            }
        }
    }
    $factura->total = $total;
    $factura->save();

    return redirect()->route('facturas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente.');
    }
   public function genFacturas(Factura $factura){
    


    $comprador = new Buyer([
    'name'          => $factura->persona->nombre,
    'custom_fields' => [
    'Telefono'          => $factura->persona->telefono,
    'Direccion'          => $factura->persona->direccion,
    ],
]);

  $vendedor = new Buyer([
    'name'          => 'alex',
    'custom_fields' => [
    'Telefono'          => '999999999',
    'Direccion'          => 'Calle alcantara',
    ],
]);

  foreach ($factura->productos as $produc) {
            $items[] = (new InvoiceItem())->title($produc->nombre)
                ->pricePerUnit($produc->precio)
                ->quantity($produc->pivot->cantidad);
        }
$invoice = Invoice::make()
    ->buyer($comprador)
    ->seller($vendedor)
    ->taxRate(21)
    ->addItems($items)
    ->currencySymbol('€')
    ->currencyCode('EUR');
return $invoice->stream();
}
}
