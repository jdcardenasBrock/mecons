<div>
    <style>
        .lead {
            font-size: 14px !important;
            font-weight: 300;
        }

        .dashboard-list-with-user {
            height: 434px !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">

                <div class="d-flex justify-content-between align-items-center">
                    <h6><b>Costos de {{$nameEdit}}</b><br>
                        <b>Numero de Contrato: </b> {{$contract_numberEdit}}
                    </h6>
                    <div class="top-right-button-container">
                        <button type="button" class="btn btn-outline-primary btn-lg top-right-button mr-1"
                            data-toggle="modal" data-backdrop="static" data-target="#editProjectModal">Editar Datos</button>
                            <a href="{{ route('project.export-pdf', $project_id) }}" class="btn btn-primary">Exportar PDF</a>

                    </div>
                </div>


                <div class="top-right-button-container ">
                    {{-- Modal para edicion --}}
                    <div class="modal fade modal-right" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProjectModalLabel">Formulario Nuevo Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nombre del Proyecto</label>
                                        <input type="text" class="form-control" wire:model.defer="nameEdit" value="{{$nameEdit}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Numero de Contrato</label>
                                        <input type="text" class="form-control" wire:model.defer="contract_numberEdit" value="{{$contract_numberEdit}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Número de Factura</label>
                                        <input type="text" class="form-control" wire:model.defer="invoice_numberEdit" value="{{$invoice_numberEdit}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Arquitecto a Cargo</label>
                                        <input type="text" class="form-control" wire:model.defer="architect_in_chargeEdit" value="{{$architect_in_chargeEdit}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ingeniero a Cargo</label>
                                        <input type="text" class="form-control" wire:model.defer="engineer_in_chargeEdit" value="{{$engineer_in_chargeEdit}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de Inicio</label>
                                        <input type="date" class="form-control" wire:model.lazy="start_dateEdit" value="{{$start_dateEdit}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha Estimada de Entrega</label>
                                        <input type="date" class="form-control" wire:model.defer="estimated_end_dateEdit" value="{{$estimated_end_dateEdit}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Valor Total del Proyecto</label>
                                        <input id="value-input" class="form-control" type="text" wire:model.defer="total_valueEdit">
                                        @error('total_valueEdit')
                                        <small class="text-danger" role="alert">{{ $message }} </small>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" wire:click="editProjectData()" data-dismiss="modal" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xl-6">

                <div class="icon-cards-row">
                    <div class="glide dashboard-numbers glide--ltr glide--slider glide--swipeable">
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides" style="transition: transform cubic-bezier(0.165, 0.84, 0.44, 1); width: 813.333px; transform: translate3d(0px, 0px, 0px);">
                                <li class="glide__slide glide__slide--active" style="width: 196.333px; margin-right: 3.5px;">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-dollar"></i>
                                            <p class="card-text mb-0">Valor Total del Proyecto:</p>
                                            <p class="lead text-center">${{ number_format($total_value, 2) }}</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="glide__slide" style="width: 196.333px; margin-left: 3.5px; margin-right: 3.5px;">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-dollar"></i>
                                            <p class="card-text mb-0">Costo Total del Proyecto:</p>
                                            <p class="lead text-center">${{ number_format($total_cost, 2) }}</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="glide__slide" style="width: 196.333px; margin-left: 3.5px; margin-right: 3.5px;">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <p class="card-text mb-0">Fecha de Inicio</p>
                                            <p class="lead text-center">
                                                @if ($start_dateEdit !=null)
                                                {{ $start_dateEdit }}
                                                @else
                                                Pendiente
                                                @endif
                                            </p>
                                            <p class="card-text mb-0 mt-1">Fecha Estimada de Cierre:</p>
                                            <p class="lead text-center">
                                                @if ($estimated_end_dateEdit !=null)
                                                {{ $estimated_end_dateEdit }}
                                                @else
                                                Pendiente
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Agregar costo</h5>
                                <div class="dashboard-quick-post">
                                    <form wire:submit="addCost">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Concepto</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" wire:model.defer="concept" placeholder="">
                                                @error('concept')
                                                <small class="text-danger" role="alert">{{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Fecha</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="date" wire:model.defer="date">
                                                @error('date')
                                                <small class="text-danger" role="alert">{{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Número de Factura</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" wire:model.defer="invoice_number" placeholder="">
                                                @error('invoice_number')
                                                <small class="text-danger" role="alert">{{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Contacto</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" wire:model.defer="contact" placeholder="">
                                                @error('contact')
                                                <small class="text-danger" role="alert">{{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Valor</label>
                                            <div class="col-sm-9">
                                                <input id="value-input" class="form-control" type="text" wire:model.lazy="value" placeholder="" oninput="formatCurrency(event)">
                                                @error('value')
                                                <small class="text-danger" role="alert">{{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Categoria</label>
                                            <div class="col-sm-9">
                                                <select wire:model.defer="category" class="form-control">
                                                    <option value="">Selecciona una categoría</option>
                                                    <option value="TRANSPORTE Y LOGISTICA">Transporte y Logística</option>
                                                    <option value="MANO DE OBRA">Mano de Obra</option>
                                                    <option value="MATERIALES">Materiales</option>
                                                    <option value="SEGURIDAD Y SALUD EN EL TRABAJO">Seguridad y Salud en el Trabajo</option>
                                                    <option value="GARANTIAS">Garantías</option>
                                                    <option value="IMPUESTOS">Impuestos</option>
                                                    <option value="HERRAMIENTAS Y EQUIPOS">Herramientas y Equipos</option>
                                                </select>
                                                @error('category')
                                                <small class="text-danger" role="alert">{{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary float-right">Agregar</button>
                                            </div>
                                        </div>
                                    </form>
                                    @if (session()->has('message'))
                                    <div class="alert alert-info rounded" role="alert">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Listado de Costos</h5>
                        <div class="col-sm-12 mt-3">
                            <div class="input-group typeahead-container">
                                <input type="text" class="form-control typeahead" name="query" id="query" placeholder="Ingrese la busqueda" data-provide="typeahead" autocomplete="off" wire:model="searchTerm">
                            </div>

                        </div>
                        <div class="scroll dashboard-list-with-user mt-5 ps">
                            @foreach ($costs as $cost)
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-semibold mb-0">{{ucwords($cost->category)}} {{ucwords($cost->concept)}} {{ucwords($cost->date)}} </p>
                                        <p class="text-muted mb-0 text-medium"><b>Contacto:</b> {{ ucwords($cost->contact)}} <b>|</b> <b>Numero de Factura:</b> {{$cost->invoice_number}} <b>|</b> <b>Valor:</b> $ {{$this->FormatAmmount($cost->value)}}</p>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="float-right mt-2 float-none-xs">
                            Cantidad de Registros: {{$costs->count()}}
                        </div>
                        <div class="float-left mt-2 float-none-xs">
                            Autosuma: $ {{$this->FormatAmmount($costs->sum('value'))}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>