@extends('layouts.app')

@section('content')
<style>
    .card-header {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }
    .btn-custom {
        min-width: 120px;
    }
    #products_table select, #products_table input {
        border-radius: 0.25rem;
    }
    #products_table tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('compra_facturas.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-header">
                        Productos
                    </div>
                    <div class="card-body">

                        <div class="form-group row mb-3">
                            <label for="persona_id" class="col-sm-1 col-form-label">Proveedor</label>
                            <div class="col-sm-4">
                                <select name="persona_id" class="form-control">
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($persona as $perso)
                                    <option value="{{ $perso->id }}" {{ old('persona_id') == $perso->id ? 'selected' : '' }}>
                                        {{ $perso->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <table class="table table-bordered mt-3" id="products_table">
                            <thead class="table-primary">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="product0">
                                    <td>
                                        <select name="productos[]" class="form-control">
                                           <option value="">Seleccione un producto</option>
                                        @foreach ($productos as $produc)
                                        <option value="{{ $produc->id }}" {{ (collect(old('productos'))->contains($produc->id)) ? 'selected' : '' }}>
                                        Stock({{ $produc->cantidad }}) {{ $produc->nombre }} (${{ number_format($produc->precio, 2) }})
                                        </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="cantidades[]" class="form-control" value="{{ old('cantidades.0', 1) }}" min="1" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="add_row" class="btn btn-success btn-custom float-left">+ Agregar producto</button>
                                <button type="button" id="delete_row" class="btn btn-danger btn-custom float-right">- Eliminar producto</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <input class="btn btn-primary btn-custom" type="submit" value="Guardar">
                    <a href="{{ route('compra_facturas.index') }}" class="btn btn-secondary btn-custom ms-2">Volver</a>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let row_number = 1;

        $("#add_row").click(function(e) {
            e.preventDefault();
            let new_row = $('#product0').clone();
            new_row.attr('id', 'productos' + row_number);
            new_row.find('select').val('');
            new_row.find('input').val(1);
            $('#products_table tbody').append(new_row);
            row_number++;
        });

        $("#delete_row").click(function(e) {
            e.preventDefault();
            if (row_number > 1) {
                $('#productos' + (row_number - 1)).remove();
                row_number--;
            }
        });
    });
</script>
@endsection
