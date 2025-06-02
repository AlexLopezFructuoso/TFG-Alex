<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\Factura;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Seller;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use Illuminate\Http\Request;

class CompraFacturaController extends VentaFacturaController
{
    /**
     * Display a listing of the purchase invoices.
     */
    public function index()
    {
       
        $facturas = Factura::with('productos', 'persona')
            ->where('tipo', 'compra')
            ->get();

        return view('facturas.compra_facturas', compact('facturas'));
    }

    /**
     * Show the form for creating a new purchase invoice.
     */
    public function create()
    {
        $productos = Producto::all();
        $persona = Persona::where('tipo', 'proveedor')->get();

        return view('facturas.crearCompraFacturas', compact('productos', 'persona'));
    }

    /**
     * Store a newly created purchase invoice in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['tipo'] = 'compra'; 

        if (empty($data['persona_id'])) {
        return redirect()->back()->withErrors(['persona_id' => 'Debe seleccionar un cliente'])->withInput();
    }

    $productos = $request->input('productos', []);
        $cantidades = $request->input('cantidades', []);

        if (empty($productos) || count(array_filter($productos)) == 0) {
        return redirect()->back()->withErrors(['productos' => 'Debe seleccionar al menos un producto'])->withInput();
    }
        

        if (!isset($data['fecha']) || empty($data['fecha'])) {
            $data['fecha'] = date('Y-m-d');
        }

        $factura = Factura::create($data);

        
 
        $total = 0;

        for ($i = 0; $i < count($productos); $i++) {
            if ($productos[$i] != '') {
                $producto = Producto::find($productos[$i]);
                if ($producto) {
                    $cantidad = $cantidades[$i];
                    $total += $producto->precio * $cantidad;
                    $factura->productos()->attach($producto->id, ['cantidad' => $cantidad]);
                }
            }
        }

        $factura->total = $total;
        $factura->save();

        return redirect()->route('compra_facturas.index');
    }

        public function destroy(string $id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();

        return redirect()->route('compra_facturas.index')->with('success', 'Factura eliminada correctamente.');
    }

    /**
     * Generate purchase invoice PDF with roles inverted.
     */
    public function genFacturas(Factura $factura)
    {
        // En facturas de compra, el usuario es comprador y la persona es vendedor
        $comprador = new Buyer([
            'name' => 'alex',
            'custom_fields' => [
                'Telefono' => '999999999',
                'Direccion' => 'Calle alcantara',
            ],
        ]);

        $vendedor = new Buyer([
            'name' => $factura->persona->nombre,
            'custom_fields' => [
                'Telefono' => $factura->persona->telefono,
                'Direccion' => $factura->persona->direccion,
            ],
        ]);

        $items = [];
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
