@extends('layouts.app')

@section('content')
    <h1 style="margin-top: 20px;">Listado</h1>

    <label for="tabla" style="font-weight: bold;">Selecciona una tabla:</label>
    <select id="tabla" class="form-select" style="width: 200px; margin-bottom: 20px;">
        <option value="">-- Selecciona --</option>
        <option value="productos">Productos</option>
        <option value="personas">Personas</option>
        <option value="facturas">Facturas</option>
        <option value="deudas">Deudas</option>
        <option value="pagos">Pagos</option>
    </select>

    <div id="contenedor-listado">
        <p>Selecciona una tabla para mostrar los datos.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
        $('#tabla').on('change', function () {
            let tipo = $(this).val();
            if (!tipo) return;

            $.ajax({
                url: "{{ route('listado.datos') }}",
                method: 'GET',
                data: { tipo: tipo },
                success: function (datos) {
                    if (datos.length === 0) {
                        $('#contenedor-listado').html('<p>No hay datos.</p>');
                        return;
                    }

                    // Obtener las columnas del primer registro
                    let columnas = Object.keys(datos[0]);

                    let html = '<h2>Listado de ' + tipo + '</h2>';
                    html += '<table class="table table-striped table-bordered table-hover"><thead><tr>';

                    columnas.forEach(col => {
                        html += '<th>' + col + '</th>';
                    });

                    html += '</tr></thead><tbody>';

                    datos.forEach(obj => {
                        html += '<tr>';
                        columnas.forEach(col => {
                            let valor = obj[col];

                            //Formatear la fecha
                           if (typeof valor === 'string' && valor.match(/^\d{4}-\d{2}-\d{2}T/)) {
                                let fecha = new Date(valor);
                                valor = fecha.toLocaleDateString('es-ES');
                            }

                            html += '<td>' + valor + '</td>';
                        });
                        html += '</tr>';
                    });
                    html += '</tbody></table>';

                    $('#contenedor-listado').html(html);
                },
                error: function () {
                    $('#contenedor-listado').html('<p>Error al obtener los datos.</p>');
                }
            });
        });
    </script>
@endsection
