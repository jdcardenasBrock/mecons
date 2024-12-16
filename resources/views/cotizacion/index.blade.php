@extends('layouts.app_dash')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Modulo de Cotizador</h1>
                
                <div class="top-right-button-container">
                    @can('crear_cotizacion')
                    <a href="{{route('cotizacion.create')}}">
                    <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1">Generar Cotización</button>
                    </a>
                    @endcan
                </div>
            </div>


            <div class="separator mb-5"></div>
            

        @can('visualizar_cotizacion')
            <form role="form" id="view_list_qoute" name="view_list_qoute" >
                <input type="hidden" id="_url" value="{{ url('cotizacion') }}">
                <input type="hidden" id="_token" value="{{ csrf_token() }}">
                <table class="table table-bordered" id="cotizacion_table">
                    <thead>
                        <tr>
                            <th>Numero de Cotización</th>
                            <th>Nombre</th>
                            <th>Cliente</th>
                            <th>Fecha de Cotización</th>
                            <th>Creado por</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </form>
        @endcan
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script>
let CotizacionsTable= $('#cotizacion_table').DataTable({
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
    processing: true,
    serverSide: true,
    search:true,
    ajax: {
        url: '{!! route("Cotizacions.data") !!}',
    },
    
    columns: [
        { data: 'num_cotizacion', name: 'cotizacions.num_cotizacion' },
        { data: 'nombreCotizacion', name: 'cotizacions.nombreCotizacion' },
        { data: 'cliente_cotizacion', name: 'clients.name' }, // Referencia explícita
        { data: 'date_created', orderable: false, searchable: false },
        { data: 'cliente_id_num', name: 'cotizacions.cliente_id_num', orderable: false, searchable: false  },
        { data: 'export', orderable: false, searchable: false },
    ]
});

$('#search-form').on('submit', function(e) {
    CotizacionsTable.draw();
    e.preventDefault();
});
function exportar(element){
    var ID =element.id;
            $.ajax({
                url: $("#view_list_qoute #_url").val() +"/"+ID+"/export" ,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'GET',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                   
                    }else{
                    alert("Ha ocurrido un error");
                    }
                }
              }).fail( function( response ) {
                alert( 'Error 101-1 : Ha ocurrido un error!' );
            });
            return false;
}
</script>
@endpush