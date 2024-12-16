@extends('layouts.app_dash')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Maestro de Clientes</h1>
                
                <div class="top-right-button-container">
                    @can('crear_cliente')
                    <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1" data-toggle="modal" data-backdrop="static" data-target="#addClientsModal">Agregar Nuevo Registro</button>
                    @endcan
                    <div class="modal fade modal-right" id="addClientsModal" tabindex="-1" role="dialog" aria-labelledby="addClientsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addClientsModalLabel">Formulario Nuevo Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_clients" name="form_clients"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('clients')}}">
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" id="id_user_create" name="id_user_create" value="{{ Auth::user()->id }}" >
                                        @csrf
                                        <div class="form-group">
                                            <label>Nombre completo del cliente</label>
                                            <input type="text" class="form-control"  id="fullnameClient" name="fullnameClient" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de Identificación</label>
                                            <select id="typeId" name="typeId" class="form-control">
                                                <option selected="">Seleccionar...</option>
                                                <option value="CC">CC</option>
                                                <option value="NIT">NIT</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Numero de Identificación</label>
                                            <input type="text" class="form-control"  id="identificationClient" name="identificationClient" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input type="text" class="form-control" placeholder="" id="directionClient" name="directionClient">
                                        </div>
                                        <div class="form-group">
                                            <label>Telefono</label>
                                            <input type="text" class="form-control" placeholder="" id="phoneClient" name="phoneClient">
                                        </div>
                                        <div class="form-group">
                                            <label>Margen Sugerido</label>
                                            <input type="number" class="form-control" placeholder="" id="marginClient" name="marginClient">
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal para edicion --}}
                    <div class="modal fade modal-right" id="EditClients" tabindex="-1" role="dialog" aria-labelledby="EditClientsLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditClientsLabel">Formulario Edición de Registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_edit_clients" name="form_edit_clients"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('clients')}}">
                                        <input type="hidden" id="_edit_id"  name="_edit_id" value="{{url('clients')}}">
                                        <input type="hidden" id="id_user_edit" name="id_user_edit" value="{{ Auth::user()->id }}" >
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nombre completo del cliente</label>
                                            <input type="text" class="form-control"  id="edit_fullnameClient" name="edit_fullnameClient" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de Identificación</label>
                                            <select id="edit_typeId" name="edit_typeId" class="form-control">
                                                <option selected="">Seleccionar...</option>
                                                <option value="CC">CC</option>
                                                <option value="NIT">NIT</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Numero de Identificación</label>
                                            <input type="text" class="form-control"  id="edit_identificationClient" name="edit_identificationClient" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input type="text" class="form-control" placeholder="" id="edit_directionClient" name="edit_directionClient">
                                        </div>
                                        <div class="form-group">
                                            <label>Telefono</label>
                                            <input type="text" class="form-control" placeholder="" id="edit_phoneClient" name="edit_phoneClient">
                                        </div>
                                        <div class="form-group">
                                            <label>Margen Sugerido</label>
                                            <input type="number" class="form-control" placeholder="" id="edit_marginClient" name="edit_marginClient">
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Editar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="separator mb-5"></div>
          
     
        @can('visualizar_cliente')
            <table class="table table-bordered" id="clients_table">
                <thead>
                    <tr>
                        
                        <th>Nombre del Cliente</th>
                        <th>Numero de Identificación</th>
                        <th>Descripción</th>
                        <th>Telefono</th>
                        <th>Margen Sugerido</th>
                        <th>Fecha de Creación</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            @endcan
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