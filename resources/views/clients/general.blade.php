@extends('layouts.app_dash')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Listado General de Equipos de Clientes</h1>  
            </div>


            <div class="separator mb-5"></div>
            <livewire:clients.equipment-general/>
        </div>
    </div>
</div>


@endsection
@push('scripts')
    <script src="{{asset('js/clients.js')}}"></script>
   <script>
       

        
      
    var ClientsTable= $('#clients_table').DataTable({
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
                Search:true,
                ajax: {
                    url: '{!! route('Clients.data') !!}',
                },
                
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'typeNumID', name: 'numID'},
                    { data: 'direccion', name: 'direccion' , orderable:false, searchable:false},
                    { data: 'telefono', name: 'telefono' , orderable:false, searchable:false},
                    {data: 'marginPorc', name:'marginPorc'},
                    { data: 'date_created', name: 'date_created', orderable:false, searchable:false },
                    { data: 'actions', name: 'actions', orderable:false, searchable:false },
                ]
        });
    $('#search-form').on('submit', function(e) {
        ClientsTable.draw();
        e.preventDefault();
    });
    //metodo para eliminar registro
    function drop(event){
        var ID =event.id;
        let confirmacion=confirm("¿Esta seguro de eliminar? No puede reversar esta accion.");
        if(confirmacion){
            $.ajax({
                url: $("#form_clients #_url").val() +"/"+ ID,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'DELETE',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#clients_table').DataTable().ajax.reload();
                    alert('Cliente eliminado exitosamente');
                    location.href=$("#_url").val();
                    }else{
                    alert(json.data);
                    }
                }
              }).fail( function( response ) {
                alert( 'Error 101-1 : No se puede Eliminar - Este registro hace parte de otro modulo!' );
            });
            return false;
                
        }
    }
    function vaciarEditInputs(){
            $("#_edit_id").val("");
            $('#edit_name_reference').val("");
            $('#edit_weights_pounds').val("");
            $('#edit_description').val("");
            $('#edit_brand').val("");
            $('#edit_notes').val("");
        }

    function edit(event){
        vaciarEditInputs();
        var ID =event.id;
            $.ajax({
                url: $("#form_clients #_url").val() +"/"+ID+"/edit" ,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'GET',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#EditClients').modal('show');
                    $("#_edit_id").val(json.data.id);
                    $('#edit_fullnameClient').val(json.data.name);
                    $('#edit_typeId').val(json.data.typeID);
                    $('#edit_identificationClient').val(json.data.numID);
                    $('#edit_directionClient').val(json.data.direccion);
                    $('#edit_phoneClient').val(json.data.telefono);
                    $('#edit_marginClient').val(json.data.margen);
                    }else{
                    alert(json.data);
                    }
                }
              }).fail( function( response ) {
                alert( 'Error 101-1 : Ha ocurrido un error!' );
            });
            return false;
    }

   
    </script>
@endpush