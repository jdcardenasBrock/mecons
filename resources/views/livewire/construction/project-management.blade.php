<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-4">Ingrese la informacion del proyecto</h5>
                    <form wire:submit.prevent="saveProject">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre del Proyecto <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="name" class="form-control">
                                    @error('name')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="contract_number">Número de Contrato <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="contract_number" class="form-control" placeholder="Número de Contrato">
                                    @error('contract_number')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="invoice_number">Número de Factura <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="invoice_number" class="form-control" placeholder="Número de Factura">
                                    @error('invoice_number')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="architect_in_charge">Arquitecto a Cargo <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="architect_in_charge" class="form-control" placeholder="Arquitecto a Cargo">
                                    @error('architect_in_charge')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="estimated_end_date">Fecha Estimada de Entrega</label>
                                    <input type="date" wire:model="estimated_end_date" class="form-control">
                                    @error('estimated_end_date')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="engineer_in_charge">Ingeniero a Cargo</label>
                                    <input type="text" wire:model="engineer_in_charge" class="form-control" placeholder="Ingeniero a Cargo">
                                    @error('engineer_in_charge')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Fecha de Inicio</label>
                                    <input type="date" wire:model="start_date" class="form-control">
                                    @error('start_date')
                                    <small class="text-danger" role="alert">{{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-0">Guardar Proyecto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @if (session()->has('message'))
    <div>{{ session('message') }}</div>
    @endif
</div>