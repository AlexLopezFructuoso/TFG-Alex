<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListadoController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/listado', [ListadoController::class, 'index'])->name('listado.index');
Route::get('/listado/datos', [ListadoController::class, 'obtenerDatos'])->name('listado.datos');

use App\Http\Controllers\VentaFacturaController;
use App\Http\Controllers\CompraFacturaController;
use App\Models\Factura;

Route::get('facturas/{factura}/generarFacturas',[VentaFacturaController::class, 'genFacturas'])->name('facturas.generarFacturas');
Route::resource('facturas', VentaFacturaController::class);

Route::get('compra_facturas/{factura}/generarFacturas', [CompraFacturaController::class, 'genFacturas'])->name('compra_facturas.generarFacturas');
Route::resource('compra_facturas', CompraFacturaController::class);

use App\Http\Controllers\BuscarController;

Route::get('/buscar', [BuscarController::class, 'index'])->name('buscar.index');
Route::get('/buscar/resultados', [BuscarController::class, 'search'])->name('buscar.resultados');
