@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Búsqueda Global</h1>
    <form action="{{ route('buscar.resultados') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Buscar..." value="{{ old('query', $query ?? '') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    @isset($query)
    <h2>Resultados para: "{{ $query }}"</h2>

    <h3>Facturas</h3>
    @if($facturas->isEmpty())
        <p>No se encontraron facturas.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                            <th>Id</th>
                            <th>Persona_id</th>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturas as $factura)
                <tr>
                    @foreach($factura->getAttributes() as $key => $value)
                        @if(!in_array($key, ['created_at', 'updated_at']))
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h3>Personas</h3>
    @if($personas->isEmpty())
        <p>No se encontraron personas.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                <tr>
                    @foreach($persona->getAttributes() as $key => $value)
                        @if(!in_array($key, ['created_at', 'updated_at']))
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h3>Productos</h3>
    @if($productos->isEmpty())
        <p>No se encontraron productos.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    @foreach($producto->getAttributes() as $key => $value)
                        @if(!in_array($key, ['created_at', 'updated_at']))
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @endisset
</div>
@endsection
