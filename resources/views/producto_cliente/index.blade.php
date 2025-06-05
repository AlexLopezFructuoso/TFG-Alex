@extends('layouts.app')

@section('content')
    <h1 style="margin-top: 20px;">Seleccionar Producto</h1>

    <form method="GET" action="{{ route('producto-cliente.index') }}">
        <label for="producto" style="font-weight: bold;">Selecciona un producto:</label>
        <select id="producto" name="producto_id" class="form-select" style="width: 300px; margin-bottom: 20px;">
            <option value="">-- Selecciona un producto --</option>
            @foreach ($productos as $producto)
                <option value="{{ $producto->id }}" {{ (isset($productoId) && $productoId == $producto->id) ? 'selected' : '' }}>
                    {{ $producto->nombre }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Mostrar Clientes</button>
    </form>

    <div id="resultado" style="margin-top: 20px;">
        @if(isset($resultados))
            @if(count($resultados) > 0)
                <h2>Clientes y Cantidad de producto comprado </h2>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultados as $item)
                            <tr>
                                <td>{{ $item->cliente }}</td>
                                <td>{{ $item->cantidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay datos para este producto.</p>
            @endif
        @else
            <p>Selecciona un producto para mostrar los clientes y cantidades.</p>
        @endif
    </div>
@endsection
