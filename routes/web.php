<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListadoController;
use App\Http\Controllers\VentaFacturaController;
use App\Http\Controllers\CompraFacturaController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\FacturasPersonasController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('facturas/{factura}/generarFacturas',[VentaFacturaController::class, 'genFacturas'])->name('facturas.generarFacturas');
    Route::resource('facturas', VentaFacturaController::class);

    Route::get('compra_facturas/{factura}/generarFacturas', [CompraFacturaController::class, 'genFacturas'])->name('compra_facturas.generarFacturas');
    Route::resource('compra_facturas', CompraFacturaController::class);

    Route::get('/buscar', [BuscarController::class, 'index'])->name('buscar.index');
    Route::get('/buscar/resultados', [BuscarController::class, 'search'])->name('buscar.resultados');
    Route::get('/personas/facturas', [FacturasPersonasController::class, 'personasFacturas'])->name('personas.facturas');

      Route::get('/producto-cliente', [\App\Http\Controllers\ProductoClienteController::class, 'index'])->name('producto-cliente.index');
    Route::get('/producto-cliente/datos', [\App\Http\Controllers\ProductoClienteController::class, 'productoClientes'])->name('producto-cliente.datos');

});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/listado', [ListadoController::class, 'index'])->name('listado.index');
    Route::get('/listado/datos', [ListadoController::class, 'obtenerDatos'])->name('listado.datos');

});
