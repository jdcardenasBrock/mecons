<div>
    @if ($message)
    <div class="alert alert-success">
        {{ $message }}
    </div>
    @endif

    <table class="table table-bordered" id="projects-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Número de Contrato</th>
                <th>Fecha de Inicio</th>
                <th>Ingeniero a Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ strtoupper($project->name) }}</td>
                <td>{{ $project->contract_number }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->engineer_in_charge }}</td>
                <td>
                    <button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opciones
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25.8px, 0px);">
                        <a href="{{route('manage_project',$project->id)}}">
                            <button type="button" class="dropdown-item">Gestionar</button></a>
                        <a href=" #">
                            <button type="button" class="dropdown-item">Eliminar</button></a>
                    </div>



                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        $('#projects-table').DataTable({
            "language": {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
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
            responsive: true,
            searching: false,

        });



    });
</script>