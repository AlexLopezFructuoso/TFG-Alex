@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Facturas por Persona</h1>

    <form method="GET" action="{{ route('personas.facturas') }}">
        <div class="form-group">
            <label for="persona_id">Selecciona una persona:</label>
            <select name="persona_id" id="persona_id" class="form-control" required>
                <option value="">-- Selecciona una persona --</option>
                @foreach($personas as $persona)
                    <option value="{{ $persona->id }}" {{ (isset($personaId) && $personaId == $persona->id) ? 'selected' : '' }}>
                        {{ $persona->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Mostrar Facturas</button>
    </form>

    @isset($facturas)
        <h2 class="mt-4">Facturas</h2>

        @if(empty($facturas))
            <p>No se encontraron facturas para esta persona.</p>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID Factura</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>{{ $item->tipo }}</td>
                            <td>{{ $item->producto_nombre ?? 'N/A' }}</td>
                            <td>{{ $item->cantidad ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endisset
</div>
@endsection

