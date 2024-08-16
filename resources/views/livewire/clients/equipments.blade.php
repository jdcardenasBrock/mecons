<div>
    <div class="row">

        <div class="col-lg-6 col-12 mb-4">
            <div class="card mb-4">
                <div class="card-body">
                    @if ($EditEquipo)
                    <p class="list-item-heading mb-4">Actualizar Equipo </p>
                    @else
                    <p class="list-item-heading mb-4">Agregar Equipo</p>
                    @endif
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="marca">Marca <small class="text-danger text-bold"><i>*</i></small></label>
                                <input type="text" class="form-control" id="marca" wire:model.defer="marca">
                                @error('marca')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre_modelo">Nombre del Modelo <small class="text-danger text-bold"><i>*</i></small></label>
                                <input type="text" class="form-control" id="nombre_modelo" wire:model.defer="nombre_modelo">
                                @error('nombre_modelo')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="modelo">Modelo</label>
                                <input type="text" class="form-control" id="modelo" wire:model.defer="modelo">
                                @error('modelo')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="serial">Serial</label>
                                <input type="text" class="form-control" id="serial" wire:model.defer="serial">
                                @error('serial')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="numero_interno"># Interno de Equipo</label>
                                <input type="text" class="form-control" id="numero_interno" wire:model.defer="numero_interno">
                                @error('numero_interno')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="ubicacion">Ubicación</label>
                                <input type="text" class="form-control" id="ubicacion" wire:model.defer="ubicacion">
                                @error('ubicacion')
                                <small class="text-danger" role="alert">{{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                        @if ($EditEquipo)
                        <button type="button" wire:click="updateEquipos" class="btn btn-warning mb-0">Actualizar</button>
                        <button type="button" wire:click="clearInputs" class="btn btn-light mb-0">Cancelar</button>
                        @else
                        <button type="button" wire:click="submitEquipos" class="btn btn-primary mb-0">Guardar</button>
                        @endif
                        <div class="row">
                            @if(!empty($successMessage))
                            <div class="col-8">
                                <div class="alert alert-success alert-dismissible fade show mt-4 pt-4" x-init="setTimeout(() => { $wire.closeMessage() }, 2000);" role="alert">
                                    {{ $successMessage }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <p class="list-item-heading mb-4">Listado de Equipos</p>
                    <div class="col-sm-12 mt-3">
                        <div class="input-group typeahead-container">
                            <input type="text" class="form-control typeahead" name="query" id="query" placeholder="Ingrese la busqueda" data-provide="typeahead" autocomplete="off" wire:model="searchTerm">
                        </div>
                    </div>
                    <div class="scroll dashboard-list-with-user mt-5 ps">
                        @foreach ($dataEquipos as $equipo)
                        <div class="d-flex flex-row mb-3 border-bottom justify-content-between">

                            <a href="#">
                                <img alt="Profile Picture" src="{{asset('img/profiles/maquina.png')}}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                            </a>
                            <div class="pl-3 flex-grow-1">
                                <a href="#">
                                    <p class="font-weight-semibold mb-0">{{ucwords($equipo->marca)}} {{ucwords($equipo->nombre_modelo)}} {{ucwords($equipo->modelo)}} </p>
                                    <p class="text-muted mb-0 text-medium"><b>Serial:</b> {{ ucwords($equipo->serial)}} <b>|</b> <b>Numero Interno:</b> {{$equipo->numero_interno}} <b>|</b> <b>Ubicación:</b> {{$equipo->ubicacion}}</p>
                                </a>
                            </div>
                            <div class="comment-likes">
                                <span class="post-icon" style="display: block ruby !important; font-size:18px">
                                    <button type="button" class="btn btn-outline-secondary mb-1" wire:click="edit('{{$this->encryptId($equipo->id)}}')">
                                        <div class="glyph-icon simple-icon-pencil"></div>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger mb-1" wire:click="drop('{{$this->encryptId($equipo->id)}}')">
                                        <div class="glyph-icon simple-icon-trash"></div>
                                    </button>
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="float-right mt-2 float-none-xs">
                        Cantidad de Registros: {{$dataEquipos->count()}}
                    </div>
                    @if(!empty($actionMessage))
                    <div class="col-10">
                        <div class="alert alert-primary rounded fade show mt-4 pt-4" x-init="setTimeout(() => { $wire.closeMessage() }, 2000);" role="alert">
                            {{ $actionMessage }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>