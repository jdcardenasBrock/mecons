@extends('layouts.app_dash')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Maestro de Referencias</h1>
                
                <div class="top-right-button-container">
                    @can('crear_referencia')
                    <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1" data-toggle="modal" data-backdrop="static" data-target="#exampleModal">Agregar Nuevo Registro</button>
                    @endcan

                    

                    <div class="modal fade modal-right" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Formulario Nuevo Registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_referencias" name="form_referencias"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('references')}}">
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tipo de registro</label>
                                            
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="complete_id" id="id_auto" value="auto" checked="">
                                                    <label class="form-check-label" for="id_auto">
                                                        Id Automatico
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="complete_id" id="id_existent" value="existent">
                                                    <label class="form-check-label" for="id_existent">
                                                        Asociar a Id existente
                                                    </label>
                                                </div>
                                        </div>
                                        <div class="form-group" id="div_id_mostrar" style="display:none;">
                                            <label>Ingrese el id a asociar</label>
                                            <input type="number" class="form-control"  id="id_asociar" name="id_asociar" placeholder="" >
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre de la referencia</label>
                                            <input type="text" class="form-control"  id="name_reference" name="name_reference" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Peso en Libras</label>
                                            <input type="number" class="form-control" step="0.01" id="weights_pounds" name="weights_pounds" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Volumen m3</label>
                                            <input type="number" class="form-control" step="0.01" id="volume" name="volume" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="form-control" rows="4" id="description" name="description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <input type="text" class="form-control" placeholder="" id="brand" name="brand">
                                        </div>
                                        <div class="form-group">
                                            <label>Notas</label>
                                            <textarea class="form-control" rows="4" id="notes" name="notes"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal para edicion --}}
                    <div class="modal fade modal-right" id="EditReference" tabindex="-1" role="dialog" aria-labelledby="EditReferenceLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditReferenceLabel">Formulario Edición de Registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_edit_referencias" name="form_edit_referencias"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('references')}}">
                                        <input type="hidden" id="_edit_id"  name="_edit_id" value="{{url('references')}}">
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nombre de la referencia</label>
                                            <input type="text" class="form-control"  id="edit_name_reference" name="edit_name_reference" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Peso en Libras</label>
                                            <input type="number" class="form-control" step="0.01"  id="edit_weights_pounds" name="edit_weights_pounds" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Volumen m3</label>
                                            <input type="number" class="form-control" step="0.01" id="edit_volume" name="edit_volume" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="form-control" rows="4" id="edit_description" name="edit_description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <input type="text" class="form-control" placeholder="" id="edit_brand" name="edit_brand">
                                        </div>
                                        <div class="form-group">
                                            <label>Notas</label>
                                            <textarea class="form-control" rows="4" id="edit_notes" name="edit_notes"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Editar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal para Asignación --}}
                    <div class="modal fade modal-right" id="AssignReference" tabindex="-1" role="dialog" aria-labelledby="AssignReferenceLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AssignReferenceLabel">Formulario de Asignación de Registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_assign_referencias" name="form_assign_referencias"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('references')}}">
                                        <input type="hidden" id="_assign_id"  name="_assign_id" value="{{url('references')}}">
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Numero del id a asociar</label>
                                            <input type="text" class="form-control"  id="assign_id_reference" name="assign_id_reference" placeholder="">
                                        </div>
                                        
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Asignar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal para ver notas --}}
                    <div class="modal fade modal-right" id="ViewNoteReference" tabindex="-1" role="dialog" aria-labelledby="ViewNoteReferenceLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ViewNoteReferenceLabel">Ver  Notas de Referencia <span id="nombre_reference_show"></span></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="card-body" id="card_reference_show" style="display: none">
                                        <p class="mb-3" id="notes_reference_show">                
                                        </p>
                                    </div>
                        
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="separator mb-5"></div>
            <div class="row">
                <div class="col-12">

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Filtrar por Parametros</h5>
                            <form method="POST" id="search-form" class="tooltip-label-right" role="form">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="error-l-0 position-relative form-group">
                                            <label for="name">Filtrar por Id: </label>
                                        <input type="text" class="form-control" name="id_refer" id="id_refer" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="error-l-25 position-relative form-group">
                                            
                                        <label for="email">Filtrar por Referencia: </label>
                                        <input type="text" class="form-control" name="name_refer" id="name_refer" placeholder="...">
                                        </div>
                                    </div>
                                </div>

                                
                                <button type="submit" class="btn btn-primary">Buscar</button>
                                <livewire:export-references />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <hr>
        @can('visualizar_referencia')
            <table class="table table-bordered" id="references_table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Referencia</th>
                        <th>Peso en Libras</th>
                        <th>Volumen</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Notas</th>
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
    <script src="{{asset('js/references.js')}}"></script>
   <script>
       
        let opcion=$('input:radio[name=complete_id]').on("click", function (){
            let opcion=$('input:radio[name=complete_id]:checked').val();
            if (opcion=="auto") {
                document.getElementById("div_id_mostrar").style.display = 'none';
            }
            if (opcion=="existent") {
                document.getElementById("div_id_mostrar").style.display = 'block';
            }
        });
        
      
    var oTable= $('#references_table').DataTable({
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
                Search:false,
                ajax: {
                    url: '{!! route('datatables.data') !!}',
                    data: function (d) {
                        d.id = $('input[id=id_refer]').val();
                        d.reference = $('input[id=name_refer]').val();
                    }
                },
                
                columns: [
                    { data: 'id_bold', name: 'id_bold', orderable:false, searchable:false },
                    { data: 'name_reference', name: 'name_reference' },
                    { data: 'weights_pounds', name: 'weights_pounds' , orderable:false, searchable:false},
                    { data: 'volume', name: 'volume' , orderable:false, searchable:false},
                    { data: 'description', name: 'description' , orderable:false, searchable:false},
                    { data: 'brand', name: 'brand' , orderable:false, searchable:false},
                    {data: 'note_limited', name:'note_limited', orderable:false, searchable:false},
                    { data: 'date_created', name: 'date_created', orderable:false, searchable:false },
                    { data: 'actions', name: 'actions', orderable:false, searchable:false },
                ]
        });
    $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    //metodo para eliminar registro
    function drop(event){
        var ID =event.id;
        let confirmacion=confirm("¿Esta seguro de eliminar? No puede reversar esta accion.");
        if(confirmacion){
            $.ajax({
                url: $("#form_referencias #_url").val() +"/"+ ID,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'DELETE',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#references_table').DataTable().ajax.reload();
                    alert('Referencia eliminada exitosamente');
                    location.href=$("#_url").val();
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
                url: $("#form_referencias #_url").val() +"/"+ID+"/edit" ,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'GET',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#EditReference').modal('show');
                    $("#_edit_id").val(json.data.id);
                    $('#edit_name_reference').val(json.data.name_reference);
                    $('#edit_weights_pounds').val(json.data.weights_pounds);
                    $('#edit_volume').val(json.data.volume);
                    $('#edit_description').val(json.data.description);
                    $('#edit_brand').val(json.data.brand);
                    $('#edit_notes').val(json.data.notes);
                    }else{
                    alert(json.data);
                    }
                }
              }).fail( function( response ) {
                alert( 'Error 101-1 : Ha ocurrido un error!' );
            });
            return false;
    }

    function assign(event){
        $('#AssignReference').modal('show');
        document.getElementById("_assign_id").value="";
        console.log("este es el id"+event.id);
        document.getElementById("_assign_id").value=event.id;
    }
    function show(event){
        var ID =event.id;
            $.ajax({
                url: $("#form_referencias #_url").val() +"/"+ID ,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'GET',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#ViewNoteReference').modal('show');
                    $('#card_reference_show').css('display', 'block');
                    $("#nombre_reference_show").text(json.data.name_reference);
                    $("#notes_reference_show").text(json.data.notes);
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