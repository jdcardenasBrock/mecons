<!DOCTYPE html>
<html>
<head>
    <title>Listado de Tareas</title>
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
    <h3>Listado de Tareas</h3>
    <p><small> Fecha de generación del reporte: {{ $currentDate }}</small> </p> <!-- Línea para la fecha -->

    <table>
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center">Estado de Venta</th>
                <th class="text-center">Fecha de Inicio</th>
                <th class="text-center">Dias de Proceso</th>
                <th class="text-center">Fecha de Vencimiento</th>
                <th class="text-center">Dias Restantes desde Hoy</th>
                <th class="text-center">Asesor</th>
                <th class="text-center">Cliente</th>
                <th class="text-center"># de Cotización</th>
                <th class="text-center">Razon</th>
                <th class="text-center">Notas</th>
                <th class="text-center">Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($dataTask as $task)
            <tr>
                <th scope="row" class="text-center">{{$task->id}}</th>
                <th scope="row" class="text-center">{{$task->statusSell}}</th>
                <th scope="row" class="text-center">{{\Carbon\Carbon::parse($task->startDate)->format('Y-m-d')}}</th>
                <th scope="row" class="text-center">{{$task->expyreDay}}</th>
                <th scope="row" class="text-center">
                    @if ($task->startDate)
                    <span style="color: #FF6A05;">{{ \Carbon\Carbon::parse($task->fecha_vencimiento)->format('Y-m-d') }}</span>
                    @endif
                </th>
                <th scope="row" class="text-center">
                    @if ($task->dias_restantes >= 0)
                    <span style="color: #FF6A05;">{{ $task->dias_restantes }} días </span>
                    @else
                    <span style="color: red;">{{ abs($task->dias_restantes) }} días vencidos</span>
                    @endif
                </th>
                <th scope="row" class="text-center">{{ucwords(strtolower($task->asesor))}}</th>
                <th scope="row" class="text-center">{{ucwords(strtolower($task->clienteName))}}</th>
                <th scope="row" class="text-center">{{ucwords(strtolower($task->qouteName))}}</th>
                <th scope="row" class="text-center">{{$task->winReason}}</th>
                <th scope="row" class="text-center">{{$task->notes}}</th>
                <th scope="row" class="text-center">
                    @if ($task->startDate)
                    <span style="color: gray;">{{ \Carbon\Carbon::parse($task->created_at)->format('Y-m-d') }}</span>
                    @endif
                </th>
            </tr>
            @empty
            <tr>
                <th colspan="9">Aun no se han asignado tareas.</th>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
