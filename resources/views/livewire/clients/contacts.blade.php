<div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    @if ($EditContacto)
                    <h5 class="mb-4">Actualizar registro de {{$EditContacto->name}} </h5>
                    @else
                    <h5 class="mb-4">Ingresar nuevo registro</h5>
                    @endif
                    <div class="form-group">
                        <label for="nombre">Nombre Completo<small class="text-danger text-bold"><i> *</i></small></label>
                        <input type="text" class="form-control" id="nombre" wire:model.defer="nombre">
                        @error('nombre')
                        <small class="text-danger" role="alert">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono<small class="text-danger text-bold"><i> *</i></small></label>
                        <input type="text" class="form-control" id="telefono" wire:model.defer="telefono">
                        @error('telefono')
                        <small class="text-danger" role="alert">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico <small class="text-danger text-bold"><i> *</i></small></label>
                        <input type="text" class="form-control" id="email" wire:model.defer="email">
                        @error('email')
                        <small class="text-danger" role="alert">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cargo<small class="text-danger text-bold"><i> *</i></small></label>
                        <input type="text" class="form-control" id="cargo" wire:model.defer="cargo">
                        @error('cargo')
                        <small class="text-danger" role="alert">{{ $message }} </small>
                        @enderror
                    </div>
                    @if ($EditContacto)
                    <button type="button" wire:click="updateClient" class="btn btn-warning mb-0">Actualizar</button>
                    <button type="button" wire:click="clearInputs" class="btn btn-light mb-0">Cancelar</button>
                    @else
                    <button type="button" wire:click="submitClient" class="btn btn-primary mb-0">Guardar</button>
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
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <p class="list-item-heading mb-4">Listado de Contactos </p>

                    <div class="col-sm-12 mt-3">
                        <div class="input-group typeahead-container">
                            <input type="text" class="form-control typeahead" name="query" id="query" placeholder="Ingrese la busqueda" data-provide="typeahead" autocomplete="off" wire:model="searchTerm">
                        </div>
                    </div>
                    <div class="scroll dashboard-list-with-user mt-5 ps">
                        @foreach ($dataContact as $contact)
                        <div class="pl-3 flex-grow-1">
                            <a href="#">
                                <img alt="Profile Picture" src="{{asset('img/profiles/l-1.jpg')}}" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                            </a>
                            <div class="pl-3">

                                <p class="font-weight-medium mb-0">{{ucwords($contact->name)}}</p>
                                <p class="text-muted mb-0 text-small mb-0">Correo electrónico: <a href="mailto:{{$contact->email}}">{{$contact->email}}</a></p>
                                <p class="text-muted mb-0 text-small">Cargo: {{ ucwords($contact->position)}} | Telefono: {{$contact->telephone}}</p>
                            </div>
                        </div>

                        <div class="comment-likes">
                            <span class="post-icon" style="display: block ruby !important; font-size:18px">
                                <button type="button" class="btn btn-outline-secondary mb-1" wire:click="edit('{{$this->encryptId($contact->id)}}')">
                                    <div class="glyph-icon simple-icon-pencil"></div>
                                </button>
                                <button type="button" class="btn btn-outline-danger mb-1" wire:click="drop('{{$this->encryptId($contact->id)}}')">
                                    <div class="glyph-icon simple-icon-trash"></div>
                                </button>
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <div class="float-right mt-2 float-none-xs">
                        Cantidad de Registros: {{$dataContact->count()}}
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