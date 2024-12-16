<div>
    @push('scripts')
    <link href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/searchpanes/2.3.2/css/searchPanes.dataTables.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/2.1.0/css/select.dataTables.css" rel="stylesheet" />
    @endpush
    <div class="top-right-button-container">
        <div class="btn-group">
            <button wire:loading.attr="disabled" style="height: max-content;" :disabled="$exportLoading"
                wire:click="exportToPDF" class="btn btn-sm btn-danger m-tools text-white "> <span
                    wire:loading wire:target="exportToPDF" class="spinner-border spinner-border-sm"
                    role="status" aria-hidden="true"></span> <span wire:loading.remove
                    wire:target="exportToPDF">PDF <i class="bi bi-file-earmark-pdf"></i></span></button>
            <button wire:loading.attr="disabled" style="height: max-content;" wire:click="exportToExcel"
                :disabled="$exportLoadingExcel" class="btn btn-sm btn-success m-tools text-white "> <span
                    wire:loading wire:target="exportToExcel" class="spinner-border spinner-border-sm"
                    role="status" aria-hidden="true"></span> <span wire:loading.remove
                    wire:target="exportToExcel">Excel <i
                        class="bi bi-file-earmark-excel"></i></span></button>
        </div>
    </div>

    <table id="taskTable" class="table mr-4 stripe row-border order-column nowrap" style="width:100%">
        <thead class="thead-light">
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
            @if ($dataTask)

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
            @endif
        </tbody>
    </table>
</div>



@push('scripts')


<script src="//cdn.datatables.net/2.1.7/js/dataTables.js"> </script>
<script src="//cdn.datatables.net/searchpanes/2.3.2/js/dataTables.searchPanes.js"> </script>
<script src="//cdn.datatables.net/searchpanes/2.3.2/js/searchPanes.dataTables.js"> </script>
<script src="//cdn.datatables.net/select/2.1.0/js/dataTables.select.js"> </script>
<script src="//cdn.datatables.net/select/2.1.0/js/select.dataTables.js"> </script>
<script>
    function initializeDataTable() {
        $('#taskTable').DataTable({
            destroy: true, // Destruye cualquier instancia previa
            "language": {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            layout: {
                top1: {
                    searchPanes: {
                        cascadePanes: true, // Para que se filtren en cascada
                        initCollapsed: true
                    }
                }
            },
            columnDefs: [{
                    searchPanes: {
                        show: true // Habilita el pane de búsqueda para esta columna
                    },
                    targets: [1, 2, 3, 4, 6, 7] // Índices de las columnas a las que aplicar SearchPanes
                },
                {
                    searchPanes: {
                        show: false // Deshabilitar panes para ciertas columnas
                    },
                    targets: [0, 5, 8, 9, 10, 11] // Otras columnas sin panes
                }
            ],
            columns: [{
                    data: 'id',
                    title: 'ID'
                },
                {
                    data: 'statusSell',
                    title: 'Estado'
                },
                {
                    data: 'startDate',
                    title: 'Fecha de Inicio'
                },
                {
                    data: 'expyreDay',
                    title: 'Días de Expiración'
                },
                {
                    data: 'fecha_vencimiento',
                    title: 'Fecha de Vencimiento'
                },
                {
                    data: 'dias_restantes',
                    title: 'Días Restantes'
                },
                {
                    data: 'asesor',
                    title: 'Asesor'
                },
                {
                    data: 'clienteName',
                    title: 'Cliente'
                },
                {
                    data: 'qouteName',
                    title: 'Cotización'
                },
                {
                    data: 'winReason',
                    title: 'Motivo Ganancia'
                },
                {
                    data: 'notes',
                    title: 'Notas'
                },
                {
                    data: 'created_at',
                    title: 'Fecha de Creación'
                },
            ],
            fixedHeader: {
                header: true,
                footer: true
            },
            scrollCollapse: true,
            scrollX: true,
            scrollY: 300,
            processing: true,
            responsive: true,
        });
    }

    // Hook para reiniciar DataTable después de la actualización del cliente seleccionado
    document.addEventListener('livewire:load', function() {
        Livewire.on('reinitializeDataTable', function() {
            let selectedClient = $('#clientFilter').val();

            if (selectedClient) {
                // Si hay un cliente seleccionado, reiniciar DataTable
                initializeDataTable();
            } else {
                // Si no hay cliente seleccionado, destruir la tabla
                $('#taskTable').DataTable().clear().destroy();
                initializeDataTable();
            }
        });
    });

    $(document).ready(function() {
        initializeDataTable();
    });
</script>
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('pdfGenerated', (pdfUrl) => {
            const link = document.createElement('a');
            link.href = pdfUrl;
            link.download = 'TAREAS.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            @this.exportLoading = false;
        });
        Livewire.on('excelGenerated', event => {
            const link = document.createElement('a');
            link.href = event;
            link.download = 'tareas.xlsx';
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            @this.exportLoadingExcel = false;
        });
    });
</script>
@endpush