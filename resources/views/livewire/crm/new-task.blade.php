<div>
    <style>
        .dashboard-list-with-user {
            height: 340px !important;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="font-size: 15px !important;">
                    <h3><b>Agregar Tarea Principal task: </b></h3>
                    <hr class="mb-4">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <div wire:ignore>
                                    <label for="clientSelected">Seleccionar Cliente <span class="text-danger">*</span></label>
                                    <select class="js-example-basic-single" name="clientSelected" id="clientSelected" wire:model="clientSelected">
                                        <option value="" selected>Select</option>
                                        @foreach ($clientsData as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('clientSelected')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <form wire:submit.prevent="saveProject">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="taskName">Nombre de la tarea</label>
                                <input type="text" class="form-control" id="taskName" wire:model.defer="taskName">
                                @error('taskName')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contactSelected">Seleccionar el contacto cliente</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <select class="form-control js-example-basic-single js-example-responsive js-states" name="contactSelected" id="contactSelected" wire:model.lazy="contactSelected">
                                        <option value="" selected>Seleccionar</option>
                                        @foreach ($infoContacts as $contact)
                                        <option value="{{$contact->id}}">{{$contact->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-prepend">
                                        @if ($clientSelected)
                                        <div class="input-group-text">
                                            <button type="button" style="margin: 0px !important; padding: 0px !important;" class="btn" data-toggle="modal" data-target="#contactModal">
                                                <div class="glyph-icon iconsminds-add"></div>
                                            </button>
                                        </div>
                                        <div class="modal fade modal-right" id="contactModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="contactModalLabel">Agregar nuevo contacto cliente</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nombre completo <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" wire:model.defer="nameContactClient" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Telefono <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" wire:model.defer="phoneContactClient" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Correo Electrónico</label>
                                                            <input type="text" class="form-control" wire:model.defer="emailContactClient" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Cargo <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" wire:model.defer="positionContactClient" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary" wire:click.prevent="saveContact" data-dismiss="modal" id="saveChangesBtn">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @error('contactSelected')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="statusSell">Seleccionar el estado Inicial de venta <span class="text-danger">*</span></label>
                                <select class="form-control js-example-basic-single js-example-responsive js-states" name="statusSell" id="statusSell" wire:model="statusSell">
                                    <option value="" selected>Seleccionar</option>
                                    <option value="Prospecto" selected>Prospecto</option>
                                    <option value="Contactado" selected>Contactado</option>
                                    <option value="Cotizado" selected>Cotizado</option>
                                </select>
                                @error('statusSell')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="start_date">Fecha de Inicio <span class="text-danger">*</span></label>
                                    <input type="date" wire:model.defer="start_date" class="form-control">
                                    @error('start_date')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="durationDays">Dias de Proceso <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="durationDays" min=0 wire:model.defer="durationDays">
                                @error('durationDays')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>

                            @if ($statusSell=="Cotizado")
                            <div class="form-group col-md-4">
                                <label for="qouteSelected">Relacionar Cotización</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <select class="form-control" name="qouteSelected" id="qouteSelected" wire:model.lazy="qouteSelected">
                                        <option value="" selected>Seleccionar</option>
                                        @foreach ($infoQoutes as $qoute)
                                        <option value="{{$qoute->id}}"># {{$qoute->num_cotizacion}} // Creada en: {{$qoute->created_at}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-prepend">
                                        @if ($qouteSelected)
                                        <div class="input-group-text">
                                            <a href="{{route('cotizacion.preview', ['id' => $qouteSelected])}}" target="_blank">
                                                <button type="button" class="btn" style="margin: 0px !important; padding: 0px !important;">
                                                    <div class="glyph-icon simple-icon-eye"></div>
                                                </button></a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @error('qouteSelected')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                            @endif
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="notes">Notas</label>
                                <textarea id="notes" class="form-control" wire:model.defer="notes" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <button type="button" wire:click="saveTask" class="btn btn-primary mb-0 mt-4">Guardar Tarea</button>
                        @if (session()->has('success_message'))
                        <div class="col-md-6 ml-0 mt-4 mb-2">
                            <div class="alert alert-success rounded" role="alert">
                                {{ session('success_message') }}
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4 mb-4">
            <div class="card mb-4">
                <div class="card h-100">
                    <div class="card-body" style="font-size: 15px !important">
                        <h5 class="card-title"><b>Listado de Tareas Principales @if ($nameClientSelected)
                                {{$nameClientSelected->name}}
                                @endif </b>
                        </h5>

                        <div class="col-sm-12 mt-3">
                            <div class="input-group typeahead-container">
                                <input type="text" class="form-control typeahead" name="query" id="query" placeholder="Ingrese la busqueda" data-provide="typeahead" autocomplete="off" wire:model="searchTerm">
                            </div>

                        </div>
                        <div class="scroll dashboard-list-with-user mt-5 ps" style="font-size: 15px !important; text-align:center">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>Nombre de Tarea</th>
                                        <th>Estado Actual</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Vencimiento</th>
                                        <th>Dias Restantes desde Hoy</th>
                                        <th>Asesor</th>
                                        <th>Notas</th>
                                        <th>Fecha de Creación</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dataTask)
                                    @if ($dataTask->isEmpty())
                                    <tr>
                                        <th colspan="9">Aun no se han asignado tareas.</th>
                                    </tr>
                                    @else
                                    @foreach ($dataTask as $task)
                                    <tr>
                                        <th scope="row">{{$task->id}}</th>
                                        <th scope="row">{{$task->taskName}}</th>
                                        <th scope="row">{{$task->current_status}}
                                            <br>
                                            @if ($task->is_active)
                                            <span class="badge badge-pill badge-outline-success mb-1">Abierta</span>
                                            @else
                                            <span class="badge badge-pill badge-outline-danger mb-1">Cerrada</span>
                                            @endif

                                        </th>
                                        <th scope="row" class="text-center">{{\Carbon\Carbon::parse($task->startDate)->format('d-m-Y')}} <br> <span class="badge badge-pill badge-light mb-1">{{$task->durationDays}} dias programados</span> </th>
                                        <th scope="row">{{\Carbon\Carbon::parse($task->expyreDate)->format('d-m-Y')}}

                                        </th>
                                        <th scope="row">
                                            @if ($task->dias_restantes >= 0)
                                            <span style="color: #FF6A05;">{{ $task->dias_restantes }} días </span>
                                            @else
                                            <span style="color: red;">{{ abs($task->dias_restantes) }} días vencidos</span>
                                            @endif
                                        </th>
                                        <th scope="row">{{ucwords(strtolower($task->asesor))}}</th>
                                        <th scope="row">{{$task->notes}}</th>
                                        <th scope="row">
                                            <span style="color: gray;">{{ \Carbon\Carbon::parse($task->created_at)->format('d-m-Y') }}</span>
                                        </th>
                                        <th scope="row">
                                            <button type="button" class="btn btn-secondary mb-1" wire:click="redirectToSubTask({{$task->id}})">Agregar Subtareas</button>
                                        </th>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-primary rounded" role="alert">
        {{ session('message') }}
    </div>
    @endif
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        $('#clientSelected').select2();

        // Escuchar cuando Select2 cambie y notificar a Livewire
        $('#clientSelected').on('change', function(e) {
            var data = $(this).val();
            @this.set('clientSelected', data);
        });

        // Resetea Select2 cuando Livewire actualiza el valor
        Livewire.on('resetSelect2', function() {
            $('#clientSelected').val('').trigger('change');
        });


    });
</script>
@endpush