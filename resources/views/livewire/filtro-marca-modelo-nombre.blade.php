<div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="responsive nowrap col-12">
                        <p class="font-weight-bold">MARCA</p>
                        <select class="custom-select form-select mt-2" wire:change="selectOption('marca', $event.target.value)"
                        wire:model="marcaNombre">
                            <option value="" selected>Seleccione una marca</option>
                            @foreach($this->marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="responsive nowrap col-12">
                        <p class="font-weight-bold">MODELO</p>

                        @if($modelos)
                        <select class="custom-select form-select mt-2" 
                        wire:change="selectOption('modelo', $event.target.value)" wire:model="modeloNombre">
                            <option value="" selected>Seleccione un modelo</option>
                            @foreach($this->modelos as $modelo)
                            <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="responsive nowrap col-12">
                        <p class="font-weight-bold">NOMBRE DEL MODELO</p>
                        @if($nombres)
                        <div style="column-count: 2; column-gap: 20px;">
                            <ol style="padding-left: 20px;">
                                @foreach($this->nombres as $nombre)
                                <li style="margin-bottom: 10px; text-transform: capitalize; font-size: medium;">
                                    <span class="badge badge-pill badge-outline-info"
                                        style="cursor: default;">
                                        {{ $nombre->nombre }}
                                    </span>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>