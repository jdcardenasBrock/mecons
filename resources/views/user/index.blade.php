@extends('layouts.app_dash')

@section('content')
<div class="container-fluid">
    <div class="row app-row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Listado de Usuarios</h1>
                <div class="top-right-button-container">
                    <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1" data-toggle="modal" data-backdrop="static" data-target="#addUser">Agregar Nuevo Usuario</button>
                    <div class="modal fade modal-right" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserLabel">Formulario Nuevo Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_add_users" name="form_add_users"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('users')}}">
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nombre Completo</label>
                                            <input type="text" class="form-control"  id="name" name="name" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Correo Electronico</label>
                                            <input type="email" class="form-control"  id="email" name="email" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input type="password" class="form-control"  id="password" name="password" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Seleccione un Rol</label>
                                                <div class="mb-4">
                                                    @foreach ($roles as $id => $role)
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="Rol_{{$id}}" name="rol_user" class="custom-control-input" value="{{$id}}">
                                                            <label class="custom-control-label" for="Rol_{{$id}}">{{$role}} </label><br>
                                                        </div>
                                                    @endforeach
                                                </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Modal para edicion --}}
                    <div class="modal fade modal-right" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="EditUserLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditUserLabel">Formulario Edición de Usuarios</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_edit_users" name="form_edit_users"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('users')}}">
                                        <input type="hidden" id="_edit_id"  name="_edit_id" value="">
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nombre Completo</label>
                                            <input type="text" class="form-control"  id="edit_name" name="edit_name" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Correo Electronico</label>
                                            <input type="email" class="form-control"  id="edit_email" name="edit_email" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input type="password" class="form-control"  id="edit_password" name="edit_password" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Seleccione un Rol</label>
                                                <div class="mb-4">
                                                    @foreach ($roles as $id => $role)
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="edit_Rol_{{$id}}" name="edit_rol_user" class="custom-control-input" value="{{$id}}">
                                                            <label class="custom-control-label" for="edit_Rol_{{$id}}">{{$role}} </label><br>
                                                        </div>
                                                    @endforeach
                                                </div>
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

            <table class="table table-bordered" id="users_table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol Asignado</th>
                        <th>Fecha de Creación</th>
                        <th></th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>
<div class="app-menu">
    <div class="p-4 h-100">
        <div class="scroll ps">
            <p class="text-muted text-small">Descripcion</p>
            <p class=" text-small">Aqui puedes encontrara todos los Usuarios con las fechas de creación correspondiente, y las acciones para editar o eliminar un registro, el realizar una acción puede alterar el funcionamiento del aplicativo web y sus componentes</p>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    </div>
    
   
</div>

@endsection
@push('scripts')
    <script src="{{asset('js/users.js')}}"></script>
   <script>
       $(function do_users_table() {
            $('#users_table').DataTable({
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
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: '{!! route('users.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    {data:'rolAsiggn', name:'rolAsiggn'},
                    { data: 'date_created', name: 'date_created' },
                    { data: 'actions', name: 'actions' },
                ]
            });
        });

        // Function for edit

        function EmptyEditInputs(){
            $("#edit_name_role").val("");
        }
    function rellenarRoles(array){
        $('input[type=checkbox]:checked').prop('checked',false);
        array.forEach(element => {
            $(`#edit_Rol_${element.id}`).prop('checked', true);
        });
    }
    function edit(event){
        EmptyEditInputs();
        var ID =event.id;
            $.ajax({
                url: $("#form_edit_users #_url").val() +"/"+ID+"/edit" ,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'GET',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#EditUser').modal('show');
                    $("#_edit_id").val(json['users'].id);
                    $("#edit_name").val(json['users'].name);
                    $("#edit_email").val(json['users'].email);
                    $("#edit_password").val(json['users'].password);
                    rellenarRoles(json['users'].roles);
                    }else{
                    alert("Ha ocurrido un error");
                    }
                }
              }).fail( function( response ) {
                alert( 'Error 101-1 : Ha ocurrido un error!' );
            });
            return false;
    }

     //metodo para eliminar registro
     function drop(event){
        var ID =event.id;
        let confirmacion=confirm("¿Esta seguro de eliminar? No puede reversar esta accion.");
        if(confirmacion){
            $.ajax({
                url: $("#form_edit_users #_url").val() +"/"+ ID,
                headers: {'X-CSRF-TOKEN': $('#form_edit_users #_token').val()},
                type: 'DELETE',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#EditUser').DataTable().ajax.reload();
                    alert('Usuario eliminado exitosamente');
                    }else{
                    alert(json.data);
                    }
                }
              }).fail( function( response ) {
                alert( 'Error 101-1 : No se puede Eliminar - Verifique Llaves Foraneas!' );
            });
            return false;
                
        }
    }


    </script>
@endpush