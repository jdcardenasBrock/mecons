<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="font-size: 15px !important;">
                    <h3><b>Agregar nueva subtarea: </b></h3>
                    <hr class="mb-4">

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
                                    <select class="form-control js-example-basic-single js-example-responsive js-states" name="contactSelected" id="contactSelected" wire:model.defer="contactSelected">
                                        <option value="" selected>Seleccionar</option>
                                        @foreach ($infoContacts as $contact)
                                        <option value="{{$contact->id}}">{{$contact->name}}</option>
                                        @endforeach
                                    </select>
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
                        <button type="button" wire:click="backTask" class="btn btn-light mb-0 mt-4">Volver</button>
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
    </div>