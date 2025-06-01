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
        <h2 class="mt-4">Facturas de {{ $personas->find($personaId)->nombre }}</h2>
        @if($facturas->isEmpty())
            <p>No se encontraron facturas para esta persona.</p>
        @else
            @foreach($facturas as $factura)
                <div class="card mb-3">
                    <div class="card-header">
                        Factura #{{ $factura->id }} - Fecha: {{ $factura->fecha }} - Tipo: {{ $factura->tipo }}
                    </div>
                    <div class="card-body">
                        <h5>Productos:</h5>
                        <ul>
                            @foreach($factura->productos as $producto)
                                <li>
                                    {{ $producto->nombre }} - Cantidad: {{ $producto->pivot->cantidad }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif
    @endisset
</div>
@endsection
