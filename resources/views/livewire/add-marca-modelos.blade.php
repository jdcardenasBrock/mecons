<div>
    <div class="row">
        <div class="col-lg-4 col-12 mb-4">
            <div class="card mb-4">
                <div class="card-body">
                    <p class="list-item-heading mb-4"><b>Agregar Datos de Equipos de Clientes</b></p>
                    <form wire:submit.prevent="save">
                        <div class="form-group position-relative">
                            <label><b>¿Desea Seleccionar o Agregar una Marca?</b></label>
                            <div class="custom-control custom-switch ml-3" style="padding-left: 30px;">
                                <input type="checkbox" class="custom-control-input"
                                    id="toggleMarca" wire:model="usarSelectMarca">
                                <label class="custom-control-label" for="toggleMarca">
                                    {{ $usarSelectMarca ? 'Seleccionar Existente' : 'Agregar Nueva' }}
                                </label>
                            </div>
                        </div>
                        <div>
                            <div class="form-group position-relative error-l-50">
                                <label><b>{{ $usarSelectMarca ? 'Seleccione una Marca' : 'Ingrese una Nueva Marca' }}</b></label>
                                @if($usarSelectMarca)
                                <select wire:model="marcaNombre" class="form-control">
                                    <option value="">-- Seleccione una Marca Existente --</option>
                                    @foreach($marcasExistentes as $marca)
                                    <option value="{{ $marca->nombre }}">{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                                @else
                                <input type="text" wire:model="marcaNombre" class="form-control" placeholder="Ingrese una nueva marca">
                                @endif
                            </div>
                            <div class="mt-2 mb-4">
                                @error('marcaNombre') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div>
                            @foreach ($modelos as $index => $modelo)
                            <div style="border: 1px solid #ccc; margin-bottom: 1rem; padding: 1rem;">
                                <div class="custom-control custom-switch  ml-3" style="padding-left: 30px;">
                                    <input type="checkbox" class="custom-control-input" id="toggleModelo{{ $index }}"
                                        wire:model="modelos.{{ $index }}.usarSelect">
                                    <label class="custom-control-label" for="toggleModelo{{ $index }}">
                                        {{ $modelo['usarSelect'] ? 'Seleccionar Existente' : 'Agregar Nuevo' }}
                                    </label>
                                </div>
                                <div class="form-group position-relative">
                                    <label><b>{{ $modelo['usarSelect'] ? 'Seleccione un Modelo' : 'Ingrese un Nuevo Modelo' }}</b></label>
                                    @if($modelo['usarSelect'])
                                    <select wire:model="modelos.{{ $index }}.nombre" class="form-control">
                                        <option value="">-- Seleccione un Modelo Existente --</option>
                                        @foreach($modelosExistentes as $modeloExistente)
                                        <option value="{{ $modeloExistente->nombre }}">{{ $modeloExistente->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <div class="input-group typeahead-container">
                                        <input type="text" class="form-control typeahead" wire:model="modelos.{{ $index }}.nombre">
                                        <div class="input-group-append ">
                                            <button type="button" wire:click="removeModelo({{ $index }})" class="btn btn-danger mb-0">
                                                <i class="simple-icon-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="mt-2 mb-4">
                                        @error('modelos.'.$index.'.nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div style="border: 1px solid #ccc; margin-bottom: 1rem; padding: 1rem;">
                                <label><b>Ingrese el Nombre del Modelo</b></label>
                                @foreach ($modelo['nombres'] as $nombreIndex => $nombre)
                                <div class="input-group typeahead-container mt-2">
                                    <input type="text" class="form-control typeahead " wire:model="modelos.{{ $index }}.nombres.{{ $nombreIndex }}.nombre">

                                    <div class="input-group-append ">
                                        <button type="button" wire:click="removeNombre({{ $index }}, {{ $nombreIndex }})" class="btn btn-danger mb-0">
                                            <i class="simple-icon-trash"></i></button>
                                    </div>
                                </div>

                                <div class="mt-2 mb-4">
                                    @error('modelos.'.$index.'.nombres.'.$nombreIndex.'.nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                @endforeach
                                <button type="button" wire:click="addNombre({{ $index }})" class="btn btn-primary mb-0 mt-4">Añadir Nombre</button>
                            </div>
                            @endforeach
                            <button type="button" wire:click="addModelo" class="btn btn-primary mb-0">Añadir Nuevo Modelo</button>
                        </div>
                        <button type="submit" class="btn btn-success mb-0 mt-4">Guardar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-8">
            <div class="card">
                <div class="card-body">
                    <p class="list-item-heading mb-4">Listado</p>
                    <livewire:filtro-marca-modelo-nombre />

                </div>
            </div>
        </div>
    </div>


    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
</div>