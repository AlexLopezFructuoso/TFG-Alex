@extends('layouts.app')

@section('content')
<style>
    .btn-group .btn {
        margin-right: 5px;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .btn-primary, .btn-danger, .btn-warning {
        min-width: 110px;
    }
    .card {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">


                    <table class="table table-bordered table-hover mt-2">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Fecha de la Factura</th>
                                <th>Proveedor</th>
                                <th>Productos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($facturas as $factu)
                            <tr data-entry-id="{{ $factu->id }}">
                                <td>{{ $factu->id ?? '' }}</td>
                                <td>{{ $factu->fecha ?? '' }}</td>
                                <td>{{ $factu->persona->nombre ?? '' }}</td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach($factu->productos as $item)
                                        <li>{{ $item->nombre }} ({{ $item->pivot->cantidad }} x ${{ $item->precio }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a href="{{ route('compra_facturas.generarFacturas', $factu->id) }}" class="btn btn-danger">Generar Factura</a>
                                        <form action="{{ route('compra_facturas.destroy', $factu->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta factura?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('compra_facturas.create') }}" class="btn btn-primary mb-3">Nueva Factura de compra</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
