{{-- resources/views/pdf/project_costs.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Costos del Proyecto</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            font-size: 13px;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h3>Costos del Proyecto: {{ $projectName }}</h3>
    <p><small> Fecha de generación del reporte: {{ $currentDate }}</small> </p> <!-- Línea para la fecha -->

    <table>
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Fecha</th>
                <th>Número de Factura</th>
                <th>Contacto</th>
                <th>Valor</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @foreach($costs as $cost)
            <tr> 
                <td>{{ ucwords($cost->concept) }}</td>
                <td>{{ $cost->date }}</td>
                <td>{{ $cost->invoice_number }}</td>
                <td>{{ ucwords($cost->contact) }}</td>
                <td>$ {{ number_format($cost->value, 2, ',', '.') }}</td>
                <td>{{ ucwords(strtolower($cost->category)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
