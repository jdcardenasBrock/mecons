@extends('layouts.app_page')

@section('content')

<div class="container-fluid" id="formulario_container" style="display: block">
    <div class="row " id="qoute_form">
        <div class="col-12">
            <div class="mb-2">
                <h1> Editar Cotizacion</h1>
                <div class="top-right-button-container">
                    <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1"
                        data-toggle="modal" data-backdrop="static" data-target="#ModalCalc"><i class="iconsminds-coins"></i></button>

                    <button type="button" class="btn btn-primary btn-lg top-right-button mr-1" data-toggle="modal" data-backdrop="static" data-target="#ModalNewItem">Agregar Item</button>

                    {{-- *********
                        Inicio de modal para agregar nuevos items a la cotización
                        **********
                        --}}

                    <div class="modal fade modal-right" id="ModalNewItem" tabindex="-1" role="dialog" aria-labelledby="ModalNewItem" aria-hidden="true">
                        <div data-notify="container" class="col-11 col-sm-3 alert alert-danger animated fadeInDown" role="alert"
                            data-notify-position="top-right" id="alert_items"
                            style="display: none; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; animation-iteration-count: 1;">
                            <button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button><span data-notify="icon"></span>
                            <span data-notify="title">Alerta</span> <span data-notify="message">Debe ingresar al menos un item!</span>
                        </div>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar nuevo item a la cotización</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="quote_provider_new" name="quote_provider_new" style="overflow-y:scroll;position:relative !important;">

                                        <input type="hidden" name="_provider" id="_provider" value="">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button" onclick="selectProviders()">Escoger Proveedor</button>
                                            </div>
                                            <input type="text" class="form-control" placeholder="" id="providerName" name="providerName" aria-describedby="basic-addon1" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <input type="text" class="form-control" id="marca" name="marca" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <input type="number" class="form-control number" id="cantidad" name="cantidad" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Referencia</label>
                                            <input type="text" class="form-control" id="referencia" name="referencia" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="">
                                        </div>
                                        <p class="text-muted text-small mb-2">IMPORTACIÓN</p>
                                        <hr>
                                        <div class="form-group">
                                            <label>Peso Unitario (LBS)</label>
                                            <input type="number" class="form-control number" placeholder="0.00" step="0.01" id="peso_unit_lbs" name="peso_unit_lbs" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Costo Unitario (USD)</label>
                                            <input type="number" class="form-control number" placeholder="0.00" step="0.01" id="costo_unit_lbs" name="costo_unit_lbs" placeholder="">
                                        </div>
                                        <p class="text-muted text-small mb-2">LOCAL</p>
                                        <hr>
                                        <div class="form-group">
                                            <label>Costo Unitario COP</label>
                                            <input type="number" class="form-control number" placeholder="0.00" step="0.01" id="costo_unit_cop" name="costo_unit_cop" placeholder="">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Días Entrega</label>
                                            <input type="number" class="form-control number" id="dias_entrega" name="dias_entrega" placeholder="">
                                        </div>

                                    </form>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" id="quote_provider_new_accept" name="quote_provider_new_accept" class="btn btn-primary">Agregar</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- *********
                        Inicio de modal para agregar el calculo de la cotización
                        **********
                        --}}
                    <div class="modal fade modal-right" id="ModalCalc" tabindex="-1" role="dialog"
                        aria-labelledby="ModalCalcLabel" aria-hidden="true">

                        <div data-notify="container" class="col-11 col-sm-3 alert alert-danger animated fadeInDown" role="alert"
                            data-notify-position="top-right" id="alert_val_calc"
                            style="display: none; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; animation-iteration-count: 1;">
                            <button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button><span data-notify="icon"></span>
                            <span data-notify="title">Alerta</span> <span data-notify="message">Debe ingresar la información de valores de calculo!</span>
                        </div>


                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar Valores de Calculo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="calcDatanew" name="calcDatanew">
                                        <input type="hidden" name="_rentabilidad" id="_rentabilidad">
                                        <input type="hidden" name="_costo_libra" id="_costo_libra">
                                        <input type="hidden" name="_trm_dia" id="_trm_dia">
                                        <input type="hidden" name="_flete_usd" id="_flete_usd">
                                        <input type="hidden" name="_flete_cop" id="_flete_cop">
                                        <input type="hidden" name="_arancel" id="_arancel">
                                        <input type="hidden" name="_comision_banco_transf_exterior" id="_comision_banco_transf_exterior">
                                        <input type="hidden" name="_nacionalizacion" id="_nacionalizacion">
                                        <input type="hidden" name="_transportadora" id="_transportadora">
                                        <input type="hidden" name="_haveCalc" id="_haveCalc" value="">

                                        <div class="form-group">
                                            <label>RENTABILIDAD ESPERADA (%) </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                                                <input type="number" id="rentabilidad" name="rentabilidad" placeholder="0.00" step="0.01" min="0" class="form-control" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>COSTO POR LIBRA (DOLARES)</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                <input type="number" id="costo_libra" name="costo_libra" placeholder="0.00" step="0.01" min="0" class="form-control number" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>VALOR TRM AL DIA</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                <input type="number" id="trm_dia" name="trm_dia" placeholder="0.00" step="0.01" min="0" class="form-control number" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>FLETES EN DOLARES </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                <input type="number" id="flete_usd" name="flete_usd" placeholder="0.00" step="0.01" min="0" class="form-control number" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>FLETE NACIONALES EN PESOS </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                <input type="number" id="flete_cop" name="flete_cop" placeholder="0.00" step="0.01" min="0" class="form-control number" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ARANCEL % </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                                                <input type="number" id="arancel" name="arancel" placeholder="0.00" step="0.01" min="0" class="form-control number" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>COMISION BANCO POR TRANSFERENCIA AL EXTERIOR </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                <input type="number" id="comision_banco_transf_exterior" name="comision_banco_transf_exterior" placeholder="0.00" step="0.01" min="0" class="form-control number" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>NACIONALIZACIÓN (PESOS)</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                <input type="number" id="nacionalizacion" name="nacionalizacion" placeholder="0.00" step="0.01" min="0" class="form-control number" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>MANEJO POR PARTE DE LA TRANSPORTADORA </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                                <input type="number" id="transportadora" name="transportadora" placeholder="0.00" step="0.01" min="0" class="form-control number" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" id="calc_new_acept" name="calc_new_acept" class="btn btn-primary">Agregar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>




                    {{-- *********
                        Inicio de modal para editar  items existentes de la cotización
                        **********
                        --}}
                    <div class="modal fade modal-right" id="ModalEditItem" tabindex="-1" role="dialog" aria-labelledby="ModalEditItem" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar item a la cotización</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="quote_provider_edit" name="quote_provider_edit">

                                        <input type="hidden" name="_id_reg" id="_id_reg" value="">
                                        <input type="hidden" name="_provider_id_edit" id="_provider_id_edit" value="">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button" onclick="selectProviders()">Escoger Proveedor</button>
                                            </div>
                                            <input type="text" class="form-control" placeholder="" id="providerName_edit" name="providerName_edit" aria-describedby="basic-addon1" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <input type="text" class="form-control" id="marca_edit" name="marca_edit" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <input type="number" class="form-control number" id="cantidad_edit" name="cantidad_edit" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Referencia</label>
                                            <input type="text" class="form-control" id="referencia_edit" name="referencia_edit" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input type="text" class="form-control" id="descripcion_edit" name="descripcion_edit" placeholder="">
                                        </div>
                                        <p class="text-muted text-small mb-2">IMPORTACIÓN</p>
                                        <hr>
                                        <div class="form-group">
                                            <label>Peso Unitario (LBS)</label>
                                            <input type="number" class="form-control number" placeholder="0.00" step="0.01" id="peso_unit_lbs_edit" name="peso_unit_lbs_edit" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Costo Unitario (USD)</label>
                                            <input type="number" class="form-control number" placeholder="0.00" step="0.01" id="costo_unit_lbs_edit" name="costo_unit_lbs_edit" placeholder="">
                                        </div>
                                        <p class="text-muted text-small mb-2">LOCAL</p>
                                        <hr>
                                        <div class="form-group">
                                            <label>Costo Unitario COP</label>
                                            <input type="number" class="form-control number" placeholder="0.00" step="0.01" id="costo_unit_cop_edit" name="costo_unit_cop_edit" placeholder="">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Días Entrega</label>
                                            <input type="number" class="form-control number" id="dias_entrega_edit" name="dias_entrega_edit" placeholder="">
                                        </div>

                                    </form>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" id="quote_provider_edit_submit" name="quote_provider_edit_submit" class="btn btn-primary">Editar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
                {{-- *********
                        Inicio de modal para seleccionar clientes
                        **********
                        --}}
                <div class="modal fade ModalFoundClient" id="ModalFoundClient" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">

                    <div data-notify="container" class="col-11 col-sm-3 alert alert-danger animated fadeInDown" role="alert"
                        data-notify-position="top-right" id="alert_client"
                        style="display: none; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px; animation-iteration-count: 1;">
                        <button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button><span data-notify="icon"></span>
                        <span data-notify="title">Alerta</span> <span data-notify="message">Debe seleccionar un cliente!</span>
                    </div>

                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Buscar Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="mb-4">Seleccione una opción</h5>
                                        <div class="row">

                                            <div class="col-12 col-sm-12">
                                                <div class="form-group position-relative error-l-75">
                                                    <label>Parametro de Busqueda</label>
                                                    <input type="text" class="form-control" name="parameterSearchClient" id="parameterSearchClient">
                                                    <small class="form-text text-muted">Debe ingresar la informacion de forma clara y sin caracteres.</small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-12" id="TableListCli" style="display: none">
                                            <div class="col-lg-12 col-md-12 mb-4">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <table id="TableListClient" class="table">

                                                            <thead class="thead-light">
                                                                <tr>

                                                                    <th scope="col">Mas Info.</th>
                                                                    <th scope="col"></th>
                                                                    <th scope="col" style="align:center">Nombre Completo</th>
                                                                    <th scope="col" style="align:center">Identificación</th>
                                                                    <th scope="col" style="align:center">Dirección</th>
                                                                    <th scope="col" style="align:center">Telefono</th>
                                                                    <th scope="col" style="align:center">Margen</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="TableBodyListClient">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="buttonSelectClient" style="display: none">
                                            <input type="button" class="btn btn-primary mb-0" id="selectClientFull" value="Escoger Cliente">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- *********
                        Inicio de modal para seleccionar proveedores al agregar nuevo item
                        **********
                        --}}
                <div class="modal fade ModalFoundProvider" id="ModalFoundProvider" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Buscar Proveedor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="mb-4">Seleccione una opción</h5>
                                        <div class="row">

                                            <div class="col-12 col-sm-12">
                                                <div class="form-group position-relative error-l-75">
                                                    <label>Parametro de Busqueda</label>
                                                    <input type="text" class="form-control" name="parameterSearchProvider" id="parameterSearchProvider">
                                                    <small class="form-text text-muted">Debe ingresar la informacion de forma clara y sin caracteres.</small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-12" id="TableListProv" style="display: none">
                                            <div class="col-lg-12 col-md-12 mb-4">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <table id="TableListProvider" class="table">

                                                            <thead class="thead-light">
                                                                <tr>

                                                                    <th scope="col">Mas Info.</th>
                                                                    <th scope="col"></th>
                                                                    <th scope="col" style="align:center">Nombre Completo</th>
                                                                    <th scope="col" style="align:center">Dirección</th>
                                                                    <th scope="col" style="align:center">Telefono</th>
                                                                    <th scope="col" style="align:center">Email</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="TableBodyListProvider">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" id="buttonSelectProvider" style="display: none">
                                            <input type="button" class="btn btn-primary mb-0" id="selectProviderFull" value="Escoger Proveedor">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="separator mb-5"></div>

            {{-- *********
                        Fila para mostrar cliente y margen seleccionado y boton para selecionar cliente
                ********** --}}

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">


                                <table class="table table-hover">
                                    <input type="hidden" name="id_client" id="id_client" value="">
                                    <input type="hidden" name="name_client" id="name_client" value="">
                                    <input type="hidden" name="cedula_client" id="cedula_client" value="">
                                    <input type="hidden" name="direc_client" id="direc_client" value="">
                                    <input type="hidden" name="tel_client" id="tel_client" tellue="">
                                    <input type="hidden" name="margen_client" id="margen_client" tellue="">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre del cliente</th>
                                            <th scope="col">Margen</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_client">

                                    </tbody>
                                </table>
                                <div class="btn-group float-right float-none-xs mt-2">
                                    <button class="btn btn-outline-secondary btn-xs" onclick="selectClient()" type="button">
                                        Seleccionar Cliente
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group position-relative error-l-50">
                                    <label>Notas de la Cotización</label>
                                    <textarea class="form-control" rows="3" name="notas_cotizacion" id="notas_cotizacion"></textarea>
                                    <small class="form-text text-muted">Must be 4 lines or less!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group position-relative error-l-50">
                                    <label>Nombre de la Cotización</label>
                                    <input type="text" class="form-control" name="nombre_cotizacion" id="nombre_cotizacion" required>
                                </div>
                                <form id="search-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="query">Buscar Referencia:</label>
                                        <input type="text" id="query" name="query" class="form-control" placeholder="..." autocomplete="off">
                                    </div>
                                    <input type="hidden" id="_url" value="{{ route('qoute.search') }}">
                                </form>

                                <div id="results">
                                    <!-- Aquí se mostrarán los resultados de la consulta -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- *********
                        Inicio de tabla de los items de la cotizacion
                        **********
                        --}}
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form role="form" id="add_qoute" name="add_qoute">
                            <input type="hidden" id="_url" value="{{ url('cotizacion') }}">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="iterator_qoute" id="iterator_qoute" value="0">
                            <input type="hidden" name="array_iterators" id="array_iterators" value="[]">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="5"></th>
                                        <th scope="col" colspan="2" style="text-align: center">IMPORTACIÓN</th>
                                        <th scope="col" colspan="2" style="text-align: center">LOCAL</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tr>
                                        <th scope="col">PROVEEDOR</th>
                                        <th scope="col">MARCA</th>
                                        <th scope="col">CANTIDAD</th>
                                        <th scope="col">REFERENCIA</th>
                                        <th scope="col">DESCRIPCIÓN</th>
                                        <th scope="col">PESO UNIT (LBS)</th>
                                        <th scope="col">COSTO UNIT USD</th>
                                        <th scope="col">COSTO UNIT COP</th>
                                        <th scope="col">DIAS ENTREGA</th>
                                        <th scope="col">OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_Qoute">


                                </tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn btn-primary mb-0">Previsualizar Cotización</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


<div id="previsualizacion_container" style="display: none">
    <div class="container-fluid">
        <div class="row app-row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Previsualización de Cotización</h1>
                    <div class="top-right-button-container">
                        <button type="button" class="btn btn-primary btn-lg top-right-button mr-1" onclick="back()">Volver al cotizador</button>
                        <button type="button" class="btn btn-primary btn-lg top-right-button mr-1" onclick="Submit_qoute()">Editar Cotización</button>
                    </div>

                    <div class="modal fade modal-right" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Details</label>
                                            <textarea class="form-control" rows="2"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control select2-single select2-hidden-accessible" data-width="100%" tabindex="-1" aria-hidden="true">
                                                <option label="&nbsp;">&nbsp;</option>
                                                <option value="Flexbox">Flexbox</option>
                                                <option value="Sass">Sass</option>
                                                <option value="React">React</option>
                                            </select><span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-control" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-rfi4-container"><span class="select2-selection__rendered" id="select2-rfi4-container" title="&nbsp;">&nbsp;</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Labels</label>
                                            <select class="form-control select2-multiple select2-hidden-accessible" multiple="" data-width="100%" tabindex="-1" aria-hidden="true">
                                                <option value="New Framework">New Framework</option>
                                                <option value="Education">Education</option>
                                                <option value="Personal">Personal</option>
                                            </select><span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple form-control" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
                                                        <ul class="select2-selection__rendered">
                                                            <li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li>
                                                        </ul>
                                                    </span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>


                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Completed</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="separator mb-5"></div>

                {{-- Inicio de Formato de Previsualización --}}
                <div class="hidden-md-down">

                    <form role="form" id="main-form">
                        <input type="hidden" id="_url" value="{{ url('cotizacion',[$data->id]) }}">
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="export_client_id" name="export_client_id" value="">
                        {{-- //Datos de items --}}
                        <input type="hidden" name="export_array" id="export_array" value="">
                        <input type="hidden" name="export_prov" id="export_prov" value="">
                        <input type="hidden" name="export_marca" id="export_marca" value="">
                        <input type="hidden" name="export_cant" id="export_cant" value="">
                        <input type="hidden" name="export_ref" id="export_ref" value="">
                        <input type="hidden" name="export_desc" id="export_desc" value="">
                        <input type="hidden" name="export_peso" id="export_peso" value="">
                        <input type="hidden" name="export_cosl" id="export_cosl" value="">
                        <input type="hidden" name="export_cosc" id="export_cosc" value="">
                        <input type="hidden" name="export_dias" id="export_dias" value="">
                        {{-- Datos de Calculo --}}
                        <input type="hidden" name="export_rentabilidad_calc" id="export_rentabilidad_calc" value="">
                        <input type="hidden" name="export_trm_dia_calc" id="export_trm_dia_calc" value="">
                        <input type="hidden" name="export_flete_usd_calc" id="export_flete_usd_calc" value="">
                        <input type="hidden" name="export_flete_cop_calc" id="export_flete_cop_calc" value="">
                        <input type="hidden" name="export_arancel_calc" id="export_arancel_calc" value="">
                        <input type="hidden" name="export_comision_banco_transf_exterior_calc" id="export_comision_banco_transf_exterior_calc" value="">
                        <input type="hidden" name="export_nacionalizacion_calc" id="export_nacionalizacion_calc" value="">
                        <input type="hidden" name="export_transportadora_calc" id="export_transportadora_calc" value="">

                        {{-- Calculos Internos --}}

                        <input type="hidden" name="export_porcPeso" id="export_porcPeso" value="">
                        <input type="hidden" name="export_pesoTotalXItem" id="export_pesoTotalXItem" value="">
                        <input type="hidden" name="export_sumaPesoTotal" id="export_sumaPesoTotal" value="">
                        <input type="hidden" name="export_costo_libra_calc" id="export_costo_libra_calc" value="">
                        <input type="hidden" name="export_costoTotalXPeso" id="export_costoTotalXPeso" value="">
                        <input type="hidden" name="export_porcPesoXItem" id="export_porcPesoXItem" value="">
                        <input type="hidden" name="export_costoTotalAntePeso" id="export_costoTotalAntePeso" value="">
                        <input type="hidden" name="export_costoValorImportXPeso" id="export_costoValorImportXPeso" value="">
                        <input type="hidden" name="export_costoValFleteInternoIntUSD" id="export_costoValFleteInternoIntUSD" value="">
                        <input type="hidden" name="export_CostoTotal" id="export_CostoTotal" value="">
                        <input type="hidden" name="export_CostoTotalPesosPartsImpor" id="export_CostoTotalPesosPartsImpor" value="">
                        <input type="hidden" name="export_costoTotalEnPesos" id="export_costoTotalEnPesos" value="">
                        <input type="hidden" name="export_costoTotalPartes" id="export_costoTotalPartes" value="">
                        <input type="hidden" name="export_costoTotalPFN" id="export_costoTotalPFN" value="">
                        <input type="hidden" name="export_costoTotalSinAdc" id="export_costoTotalSinAdc" value="">
                        <input type="hidden" name="export_GranTotalEnPesosPartsImport" id="export_GranTotalEnPesosPartsImport" value="">
                        <input type="hidden" name="export_GranTotalCostoPesos" id="export_GranTotalCostoPesos" value="">
                        <input type="hidden" name="export_CostoUnitPesosPartsImpor" id="export_CostoUnitPesosPartsImpor" value="">
                        <input type="hidden" name="export_PorcPesosAcuerdoPesos" id="export_PorcPesosAcuerdoPesos" value="">
                        <input type="hidden" name="export_Res_costoGranTotalPesosconAdc" id="export_Res_costoGranTotalPesosconAdc" value="">
                        <input type="hidden" name="export_costoTotalPesosImporMasNal" id="export_costoTotalPesosImporMasNal" value="">
                        <input type="hidden" name="export_precioVentaTotalXItem" id="export_precioVentaTotalXItem" value="">
                        <input type="hidden" name="export_precioVentaUnitarioXItem" id="export_precioVentaUnitarioXItem" value="">
                        <input type="hidden" name="export_precioGranTotalVenta" id="export_precioGranTotalVenta" value="">
                        <input type="hidden" name="export_rentabilidadFinal" id="export_rentabilidadFinal" value="">
                        <input type="hidden" name="export_rentabilidadFinalPorc" id="export_rentabilidadFinalPorc" value="">
                        <input type="hidden" name="export_dolarRealCalc" id="export_dolarRealCalc" value="">

                        <input type="hidden" name="export_ivaFinal" id="export_ivaFinal" value="">
                        <input type="hidden" name="export_Gran_Total" id="export_Gran_Total" value="">

                        <input type="hidden" name="export_nombre" id="export_nombre" value="">
                        <input type="hidden" name="export_notas" id="export_notas" value="">
                    </form>
                </div>
                <div class="row invoice" id="invoice" style="display: block">
                    <div class="col-12">
                        <div class="invoice-contents" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background-color:#ffffff; height:1200px; max-width:830px; font-family: Helvetica,Arial,sans-serif !important; position: relative;">
                            <table style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px;" heigth="auto" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">

                                <tbody>
                                    <tr>
                                        <td style="padding-bottom:35px; padding-top:15px; border-top:0;width:100% !important;float:left" valign="left" align="left">
                                            <span class="logo d-none d-xs-block"></span>
                                        </td>
                                        <td style="padding-left:25px; padding-top:5px; border-top:0;width:100% !important;float:center" valign="left" align="left">
                                            <p style="color: #242128; font-weight: 500; line-height: 1.2; font-size: 12px;text-align:center">
                                                <strong>MECONS INGENIERIA Y CONSTRUCCIÓN SAS</strong><br> NIT901480317-6
                                            </p>
                                        </td>
                                        <td style="padding-bottom:15px; padding-top:15px; border-top:0;width:100% !important;" valign="center" align="right">
                                            <p style="color: #8f8f8f; font-weight: normal; line-height: 1.2; font-size: 12px; white-space: nowrap; ">
                                                3142277964<br> WWW.MECONS.COM.CO<br>diego.cardenas@mecons.com.co<br> CRA. 73 # 3 - 69 - Bogotá D.C.
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding-top:30px; border-top:1px solid #f1f0f0">
                                            <table style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align:left; font-size: 13px; color:#8f8f8f; padding-bottom: 15px;">
                                                            Cotización
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td style="vertical-align:middle; border-radius: 3px; padding:30px; background-color: #f9f9f9; border-right: 5px solid white;">
                                                            <p style="color:#303030; font-size: 13px;  line-height: 1.6; margin:0; padding:0;" id="contact_client">

                                                            </p>
                                                        </td>

                                                        <td style="text-align: right; padding-top:0px; padding-bottom:0; vertical-align:middle; padding:30px; background-color: #f9f9f9; border-radius: 3px; border-left: 5px solid white;">
                                                            <p style="color:#D95C00; font-size: 14px; padding: 0; line-height: 1.6; margin:0; " id="contact_qoute">
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table style="width: 100%; margin-top:40px;">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                            ITEM
                                                        </th>
                                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                            CANTIDAD
                                                        </th>
                                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                            REFERENCIA
                                                        </th>
                                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                            DESCRIPCIÓN
                                                        </th>
                                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                            MARCA
                                                        </th>
                                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                            DIAS ENTREGA
                                                        </th>
                                                        <th style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                            PRECIO UNITARIO
                                                        </th>
                                                        <th style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                            TOTAL
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="content_items_qoute">


                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table style="position:absolute; bottom:0; width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px; padding-top: 20px;" heigth="auto" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                <tbody>
                                    <tr>
                                        <td style="width: 100%" colspan="3">
                                            <p id="numerosLetras" style="font-size: 13px; text-decoration: uppercase; line-height: 1.6; color:black; margin-top:0px; margin-bottom:0; text-align: left; background-color:#cccbcb;">
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%" colspan="1">
                                            <p href="#" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: left;">
                                                Observaciones</p>
                                        </td>
                                        <td style="padding-top:0px; text-align: right;">
                                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                                Subtotal</p>
                                        </td>
                                        <td style="padding-top:0px; text-align: right;">
                                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px" id="SubtotalPrev">

                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%" colspan="1">
                                            <p href="#" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: left;">
                                            </p>
                                        </td>
                                        <td style="padding-top:0px; text-align: right;">
                                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                                IVA (19%)</p>
                                        </td>
                                        <td style="padding-top:0px; text-align: right;">
                                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px" id="valIvaSubtotal">
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%" colspan="1">
                                            <p href="#" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: left;">
                                            </p>
                                        </td>
                                        <td style="padding-top:0px; text-align: right;">
                                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                                Total</p>
                                        </td>
                                        <td style="padding-top:0px; text-align: right;">
                                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; font-weight:800; vertical-align:top; white-space:nowrap; margin-left:15px" id="totalCotizacion">
                                            </p>
                                        </td>
                                    </tr>
                                    <td colspan="3" style="border-top:1px solid #f1f0f0">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align:center;">
                                            <p style="color: #909090; font-size:11px; text-align:center;">Invoice was created
                                                on a computer and
                                                is valid without the signature and seal. </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll ps">
                <p class="text-muted text-small">Valores Introducidos</p>
                <ul class="list-unstyled mb-5">
                    <li class="active">
                        <b>RENTABILIDAD ESPERADA:</b><br>
                        <p id="label_app_menu_rent"></p>
                    </li>
                    <li>
                        <b>COSTO POR LIBRA USD:</b><br>
                        <p id="label_app_menu_costo"></p>
                    </li>
                    <li>
                        <b>VALOR TRM AL DIA:</b><br>
                        <p id="label_app_menu_trm"></p>
                    </li>
                    <li>
                        <b>FLETES EN USD:</b><br>
                        <p id="label_app_menu_fleteusd"></p>
                    </li>
                    <li>
                        <b>FLETE NACIONALES COP:</b><br>
                        <p id="label_app_menu_fletecop"></p>
                    </li>
                    <li>
                        <b>ARANCEL :</b><br>
                        <p id="label_app_menu_aranc"></p>
                    </li>
                    <li>
                        <b>COMISION BANCO POR TRANSFERENCIA AL EXTERIOR USD:</b><br>
                        <p id="label_app_menu_comision"></p>
                    </li>
                    <li>
                        <b>NACIONALIZACION COP:</b><br>
                        <p id="label_app_menu_nacionaliza"></p>
                    </li>
                    <li>
                        <b>MANEJO POR PARTE DE LA TRANSPORTADORA COP:</b><br>
                        <p id="label_app_menu_transport"></p>
                    </li>
                </ul>



                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
        </div>
        <a class="app-menu-button d-inline-block d-xl-none" href="#">
            <i class="simple-icon-options"></i>
        </a>
    </div>
</div>
@endsection
@push('scripts')
<script>
    let infoQoute = @json($data);
    let infoClient = @json($client);
    let strArray = JSON.parse(infoQoute.array);
    let Finalarray = strArray.split(',');
    console.log(Finalarray);
    $(document).ready(function() {
        setBlankForms();
        fillQoute(infoQoute, infoClient);
        $('#query').on('input', function () {
            const query = $(this).val();
            const url = $('#_url').val();

            if (query.length > 2) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: { query: query },
                    success: function (response) {
                        $('#results').html('');
                        if (response.length > 0) {
                            response.forEach(item => {
                                $('#results').append('<p> Peso Total lb: ' + item.weights_pounds+" |  Volumen Total m3: "+item.volume+'</p>');
                            });
                        } else {
                            $('#results').html('<p>No se encontraron resultados.</p>');
                        }
                    },
                    error: function () {
                        $('#results').html('<p>Ocurrió un error al realizar la consulta.</p>');
                    }
                });
            } else {
                $('#results').html('');
            }
        });
    });

    function fillQoute(infoQoute, infoClient) {

        document.getElementById("iterator_qoute").value = Finalarray.length;
        document.getElementById("array_iterators").value = Finalarray;
        document.getElementById("notas_cotizacion").value = infoQoute.notas;
        document.getElementById("nombre_cotizacion").value = infoQoute.nombreCotizacion;
        //Rellenado en valores de calculo oculto
        document.getElementById("_rentabilidad").value = infoQoute.rentabilidad_calc;
        document.getElementById("_costo_libra").value = infoQoute.costo_libra_calc;
        document.getElementById("_trm_dia").value = infoQoute.trm_dia_calc;
        document.getElementById("_flete_usd").value = infoQoute.flete_usd_calc;
        document.getElementById("_flete_cop").value = infoQoute.flete_cop_calc;
        document.getElementById("_arancel").value = infoQoute.arancel_calc;
        document.getElementById("_comision_banco_transf_exterior").value = infoQoute.comision_banco_transf_exterior_calc;
        document.getElementById("_nacionalizacion").value = infoQoute.nacionalizacion_calc;
        document.getElementById("_transportadora").value = infoQoute.transportadora_calc;
        $("#_haveCalc").val(true);
        //Rellenado en valores de calculo visible
        document.getElementById("rentabilidad").value = infoQoute.rentabilidad_calc;
        document.getElementById("costo_libra").value = infoQoute.costo_libra_calc;
        document.getElementById("trm_dia").value = infoQoute.trm_dia_calc;
        document.getElementById("flete_usd").value = infoQoute.flete_usd_calc;
        document.getElementById("flete_cop").value = infoQoute.flete_cop_calc;
        document.getElementById("arancel").value = infoQoute.arancel_calc;
        document.getElementById("comision_banco_transf_exterior").value = infoQoute.comision_banco_transf_exterior_calc;
        document.getElementById("nacionalizacion").value = infoQoute.nacionalizacion_calc;
        document.getElementById("transportadora").value = infoQoute.transportadora_calc;
        //Relleno de datos de clientes
        document.getElementById("id_client").value = infoClient.id;
        document.getElementById("name_client").value = infoClient.name;
        document.getElementById("cedula_client").value = infoClient.numID;
        document.getElementById("direc_client").value = infoClient.direccion;
        document.getElementById("tel_client").value = infoClient.telefono;
        document.getElementById("margen_client").value = infoClient.margen;
        document.getElementById("tbody_client").innerHTML = `<tr><td>${infoClient.name}</td><td>${infoClient.margen}</td>`;
        //Relleno de datos de Items
        let array_json_info = JSON.parse(infoQoute.array);
        let array_info = array_json_info.split(',');

        let prov_json = JSON.parse(infoQoute.prov);
        let array_prov = prov_json.split(',');

        let marca_json = JSON.parse(infoQoute.marca);
        let array_marca = marca_json.split(',');

        let cant_json = JSON.parse(infoQoute.cant);
        let array_cant = cant_json.split(',');

        let ref_json = JSON.parse(infoQoute.ref);
        let array_ref = ref_json.split(',');

        let desc_json = JSON.parse(infoQoute.desc);
        let array_desc = desc_json.split(',');

        let peso_json = JSON.parse(infoQoute.peso);
        let array_peso = peso_json.split(',');

        let cosl_json = JSON.parse(infoQoute.cosl);
        let array_cosl = cosl_json.split(',');

        let cosc_json = JSON.parse(infoQoute.cosc);
        let array_cosc = cosc_json.split(',');

        let dias_json = JSON.parse(infoQoute.dias);
        let array_dias = dias_json.split(',');

        array_info.forEach(function(element, index) {

            $("#tbody_Qoute").append(
                $('<tr id="reg_' + element + '">').append(
                    $('<input type="hidden" id="num_provider_id_' + element + '" value=' + element + '>'),
                    $('<td id="provider_' + element + '" >').css('text-align', 'center').append(array_prov[index])
                ).append(
                    $('<td id="marca_' + element + '">').css('text-align', 'center').append(array_marca[index])
                ).append(
                    $('<td id="cantidad_' + element + '">').css('text-align', 'center').append(array_cant[index])
                ).append(
                    $('<td id="referencia_' + element + '">').css('text-align', 'center').append(array_ref[index])
                ).append(
                    $('<td id="descripcion_' + element + '">').css('text-align', 'center').append(array_desc[index])
                ).append(
                    $('<td id="peso_unit_lbs_' + element + '">').css('text-align', 'center').append(array_peso[index])
                ).append(
                    $('<td id="costo_unit_lbs_' + element + '">').css('text-align', 'center').append(array_cosl[index])
                ).append(
                    $('<td id="costo_unit_cop_' + element + '">').css('text-align', 'center').append(array_cosc[index])
                ).append(
                    $('<td id="dias_entrega_' + element + '">').css('text-align', 'center').append(array_dias[index])
                ).append(
                    $('<td>').css('text-align', 'center').append(
                        '<button type="button" onclick="drop(' + element + ')" class="btn btn-danger default"> <i class="glyph-icon simple-icon-trash"></i></button>' +
                        '<button type="button" onclick="edit(' + element + ')" class="btn btn-info default"> <i class="glyph-icon simple-icon-pencil"></i></button>'
                    )
                )
            );
        });

    }

    function setBlankForms() {
        //Formulario de valores de calculo
        let rentab = "sa";
        document.getElementById("rentabilidad").innerHTML = rentab;
        $("#_rentabilidad").val(rentab);
        $("#_costo_libra").val("");
        $("#_trm_dia").val("");
        $("#_flete_usd").val("");
        $("#_flete_cop").val("");
        $("#_arancel").val("");
        $("#_comision_banco_transf_exterior").val("");
        $("#_nacionalizacion").val("");
        $("#_transportadora").val("");
        $("#_haveCalc").val(false);
        //Inputs
        $("#rentabilidad").val("");
        $("#costo_libra").val("");
        $("#trm_dia").val("");
        $("#flete_usd").val("");
        $("#flete_cop").val("");
        $("#arancel").val("");
        $("#comision_banco_transf_exterior").val("");
        $("#nacionalizacion").val("");
        $("#transportadora").val("");
        // Formulario de Edicion de item
        $("#_id_reg").val("");
        $("#_provider_id_edit").val("");
        $("#providerName_edit").val("");
        $("#marca_edit").val("");
        $("#cantidad_edit").val("");
        $("#referencia_edit").val("");
        $("#descripcion_edit").val("");
        $("#peso_unit_lbs_edit").val("");
        $("#costo_unit_lbs_edit").val("");
        $("#costo_unit_cop_edit").val("");
        $("#dias_entrega_edit").val("");
        // Formulario de Ingreso de item
        $("#_provider").val("");
        $("#providerName").val("");
        $("#marca").val("");
        $("#cantidad").val("");
        $("#referencia").val("");
        $("#descripcion").val("");
        $("#peso_unit_lbs").val("");
        $("#costo_unit_lbs").val("");
        $("#costo_unit_cop").val("");
        $("#dias_entrega").val("");

        //Inputs de Busqueda de opciones por parametro
        $("#parameterSearchClient").val("");
        $("#parameterSearchProvider").val("");


    }
    ////
    //*****
    // INICIO FUNCIONES PARA MODALES Y SUPLEMENTOS CLIENTES
    //*****
    ////

    //
    //Funcion para mostrar el modal de buscar clientes por parametro
    //

    function selectClient() {
        $("#ModalFoundClient").modal('show');
        document.getElementById("ModalFoundClient").style.display = "block";
    }

    //
    //Funcion para listar la tabla dentro del modal
    // segun la opcion escogida y el parametro dado
    //

    function ListClient(typeSearch) {
        let data = typeSearch;

        let e = "{{ route('ajax.ruta.showClients')}}/" + data;
        let table = $('#TableListClient').DataTable({
            "paging": false,
            "searching": false,

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
            "order": [
                [0, "asc"]
            ],
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ajax": e,
            "columns": [{
                    "data": "empty",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "actions",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "name"
                },
                {
                    "data": "identification"
                },
                {
                    "data": "direccion"
                },
                {
                    "data": "telefono"
                },
                {
                    "data": "margen",
                    orderable: false,
                    searchable: false
                },
            ],
        });
    }

    //
    //Evento click - cuando se da clic en el boton de
    //buscar y se ejecuta la funcion ListClient() para listar 
    //los clientes segun la opción dada
    //

    $("#parameterSearchClient").on("keyup", function() {
        $('#TableListClient').DataTable().destroy();
        $('#TableListCli').show();
        $('#buttonSelectClient').show();
        let typeSearch = $(this).val();
        if (typeSearch != "") {
            ListClient(typeSearch);
        } else if (typeSearch == "") {
            $('#TableListClient').DataTable().destroy();
            $("#parameterSearchClient").val("");
            $("#TableBodyListClient tr").remove();
        }

    });

    //
    //Evento click - obtiene el item seleccionado de los clientes
    //quita la tabla, oculta el modal, hace peticion ajax para traer 
    //la informacion necesaria y la asigna
    //

    $("#selectClientFull").click(function() {
        let guestSelected = document.querySelector('input[name="Clients"]:checked').value;

        $("#parameterSearchClient").val("");
        $('#TableListClient').DataTable().destroy();
        $("#TableBodyListClient tr").remove();
        $("#ModalFoundClient").modal('hide');
        $.ajax({
            url: $('#add_qoute #_url').val() + "/findGuest/" + guestSelected,
            headers: {
                'X-CSRF-TOKEN': $('#add_qoute #_token').val()
            },
            type: 'GET',
            cache: false,
            data: guestSelected,
            success: function(response) {
                $("#id_client").val(response.id);
                $("#name_client").val(response.name);
                $("#cedula_client").val(response.typeID + " - " + response.numID);
                $("#direc_client").val(response.direccion);
                $("#tel_client").val(response.telefono);
                $("#margen_client").val(response.margen);

                document.getElementById("tbody_client").innerHTML = `<tr><td>${response.name}</td><td>${response.margen}</td>`;
            }
        });
    });

    ////
    //*****
    // FIN FUNCIONES PARA MODALES Y SUPLEMENTOS CLIENTES
    //*****
    ////---------------------------------------------------



    ////---------------------------------------------------
    //*****
    // INICIO FUNCIONES PARA MODALES Y SUPLEMENTOS PROVEEDORES
    //*****
    ////

    //
    //Funcion para mostrar el modal de buscar clientes por parametro
    //

    function selectProviders() {
        $("#ModalFoundProvider").modal('show');
        document.getElementById("ModalFoundProvider").style.display = "block";
    }
    // Funcion para eliminar los registros de la cotización
    function drop(id) {
        let opcion = confirm("¿Esta seguro de eliminar el item?")
        if (opcion == true) {
            let pos = Finalarray.indexOf(id.toString());
            if (pos != -1) {
                Finalarray.splice(pos, 1);
                $("#array_iterators").val(Finalarray);
                let iteratorNew = parseInt($("#iterator_qoute").val());
                iteratorNew = iteratorNew - 1;
                $("#iterator_qoute").val(iteratorNew)
                $('#reg_' + id).remove();
            } else {
                alert("No se ha podido eliminar el registro");
            }

        }
    }

    // Funcion para eliminar los registros de la cotización
    function edit(id) {
        let provider_id = document.getElementById('num_provider_id_' + id).value;
        let provider = document.getElementById('provider_' + id).innerHTML;
        let marca = document.getElementById('marca_' + id).innerHTML;
        let cantidad = document.getElementById('cantidad_' + id).innerHTML;
        let referencia = document.getElementById('referencia_' + id).innerHTML;
        let descripcion = document.getElementById('descripcion_' + id).innerHTML;
        let peso_unit_lbs = document.getElementById('peso_unit_lbs_' + id).innerHTML;
        let costo_unit_lbs = document.getElementById('costo_unit_lbs_' + id).innerHTML;
        let costo_unit_cop = document.getElementById('costo_unit_cop_' + id).innerHTML;
        let dias_entrega = document.getElementById("dias_entrega_" + id).innerHTML;


        $("#_id_reg").val(id);
        $("#_provider_id_edit").val(provider_id);
        $("#providerName_edit").val(provider);
        $("#marca_edit").val(marca);
        $("#cantidad_edit").val(cantidad);
        $("#referencia_edit").val(referencia);
        $("#descripcion_edit").val(descripcion);
        $("#peso_unit_lbs_edit").val(peso_unit_lbs);
        $("#costo_unit_lbs_edit").val(costo_unit_lbs);
        $("#costo_unit_cop_edit").val(costo_unit_cop);
        $("#dias_entrega_edit").val(dias_entrega);
        $("#ModalEditItem").modal('show');
    }




    ////---------------------------------------------------
    //*****
    // INICIO FUNCIONES PARA SUBMIT EDICION DE ITEMS
    //*****
    ////
    $("#quote_provider_edit_submit ").click(function(event) {

        if ($("#_id_reg").val() == "") {
            alert("No existe identificador del registro", "Atencion!");
            $("#_id_reg").focus();
            return false;
        }
        if ($("#_provider_id_edit").val() == "") {
            alert("Debe seleccionar el proveedor", "Atencion!");
            $("#_provider_id_edit").focus();
            return false;
        }
        if ($("#providerName_edit").val() == "") {
            alert("Debe seleccionar el proveedor", "Atencion!");
            $("#providerName_edit").focus();
            return false;
        }
        if ($("#marca_edit").val() == "") {
            alert("Debe ingresar la marca", "Atencion!");
            $("#marca_edit").focus();
            return false;
        }
        if ($("#cantidad_edit").val() == "") {
            alert("Debe ingresar la cantidad", "Atencion!");
            $("#cantidad_edit").focus();
            return false;
        }
        if ($("#referencia_edit").val() == "") {
            alert("Debe ingresar la referencia", "Atencion!");
            $("#referencia_edit").focus();
            return false;
        }
        if ($("#descripcion_edit").val() == "") {
            alert("Debe ingresar la descripcion", "Atencion!");
            $("#descripcion_edit").focus();
            return false;
        }
        if ($("#peso_unit_lbs_edit").val() == "") {
            alert("Debe ingresar el peso unitario", "Atencion!");
            $("#peso_unit_lbs_edit").focus();
            return false;
        }
        if ($("#costo_unit_lbs_edit").val() == "") {
            alert("Debe ingresar el costo unitario", "Atencion!");
            $("#costo_unit_lbs_edit").focus();
            return false;
        }
        if ($("#costo_unit_cop_edit").val() == "") {
            alert("Debe ingresar el costo unitario COP", "Atencion!");
            $("#costo_unit_cop_edit").focus();
            return false;
        }
        if ($("#dias_entrega_edit").val() == "") {
            alert("Debe ingresar los días de entrega", "Atencion!");
            $("#dias_entrega_edit").focus();
            return false;
        }

        function vaciarInputsEditItem() {
            $("#_id_reg").val("");
            $("#_provider_id_edit").val("");
            $("#providerName_edit").val("");
            $("#marca_edit").val("");
            $("#cantidad_edit").val("");
            $("#referencia_edit").val("");
            $("#descripcion_edit").val("");
            $("#peso_unit_lbs_edit").val("");
            $("#costo_unit_lbs_edit").val("");
            $("#costo_unit_cop_edit").val("");
            $("#dias_entrega_edit").val("");
        }

        let confirmacion = confirm("¿Esta seguro de editar esta información?");
        if (confirmacion) {
            let iterator = $("#_id_reg").val();
            let proveedor = $("#providerName_edit").val();
            let proveedor_id = $("#_provider_id_edit").val();
            let marca = $("#marca_edit").val();
            let cant = $("#cantidad_edit").val();
            let refer = $("#referencia_edit").val();
            let desc = $("#descripcion_edit").val();
            let pesoLbs = $("#peso_unit_lbs_edit").val();
            let costoLbs = $("#costo_unit_lbs_edit").val();
            let costoCop = $("#costo_unit_cop_edit").val();
            let dias = $("#dias_entrega_edit").val();


            $("#num_provider_id_" + iterator).text(proveedor_id);
            $("#provider_" + iterator).text(proveedor);
            $("#marca_" + iterator).text(marca);
            $("#cantidad_" + iterator).text(cant);
            $("#referencia_" + iterator).text(refer);
            $("#descripcion_" + iterator).text(desc);
            $("#peso_unit_lbs_" + iterator).text(pesoLbs);
            $("#costo_unit_lbs_" + iterator).text(costoLbs);
            $("#costo_unit_cop_" + iterator).text(costoCop);
            $("#dias_entrega_" + iterator).text(dias);
            vaciarInputsEditItem();
            $("#ModalEditItem").modal('hide');
            return false;
        }
    })


    //
    //Funcion para listar la tabla dentro del modal
    // segun la opcion escogida y el parametro dado
    //

    function ListProvider(typeSearch) {
        let data = typeSearch;

        let e = "{{ route('ajax.ruta.showProvider')}}/" + data;
        let table = $('#TableListProvider').DataTable({
            "paging": false,
            "searching": false,

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
            "order": [
                [0, "asc"]
            ],
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ajax": e,
            "columns": [{
                    "data": "empty",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "actions",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "name"
                },
                {
                    "data": "direction"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "email"
                },
            ],
        });
    }

    //
    //Evento click - cuando se da clic en el boton de
    //buscar y se ejecuta la funcion ListClient() para listar 
    //los clientes segun la opción dada
    //

    $("#parameterSearchProvider").on("keyup", function() {

        $('#TableListProvider').DataTable().destroy();
        $('#TableListProv').show();
        $('#buttonSelectProvider').show();

        let parameter = document.getElementById("parameterSearchProvider").value;
        if (parameter != "") {
            ListProvider(parameter);
        } else if (parameter == "") {

            $('#TableListProvider').DataTable().destroy();
            $("#TableBodyListProvider tr").remove();
            $("#parameterSearchProvider").val("");
        }
    });

    //
    //Evento click - obtiene el item seleccionado de los clientes
    //quita la tabla, oculta el modal, hace peticion ajax para traer 
    //la informacion necesaria y la asigna
    //

    $("#selectProviderFull").click(function() {
        let providerSelected = document.querySelector('input[name="Provider"]:checked').value;
        if (providerSelected == "") {
            alert("Debe ingresar el parametro de busqueda.");
        } else {
            $("#parameterSearchProvider").val("");
            $('#TableListProvider').DataTable().destroy();
            $("#TableBodyListProvider tr").remove();
            $("#ModalFoundProvider").modal('hide');
            $.ajax({
                url: $('#add_qoute #_url').val() + "/findProvider/" + providerSelected,
                headers: {
                    'X-CSRF-TOKEN': $('#add_qoute #_token').val()
                },
                type: 'GET',
                cache: false,
                data: providerSelected,
                success: function(response) {
                    document.getElementById("_provider").value = response.id;
                    document.getElementById("providerName").value = response.name;
                    document.getElementById("_provider_id_edit").value = response.id;
                    document.getElementById("providerName_edit").value = response.name;
                }
            });
        }

    });

    ////
    //*****
    // FIN FUNCIONES PARA MODALES Y SUPLEMENTOS CLIENTES
    //*****
    ////

    $("#calc_new_acept").click(function() {
        if ($("#rentabilidad").val() == "") {
            alert("Debe ingresar la rentabilidad", "Atencion!");
            $("#rentabilidad").focus();
            return false;
        }
        if ($("#costo_libra").val() == "") {
            alert("Debe ingresar el costo por libra (dolares)", "Atencion!");
            $("#costo_libra").focus();
            return false;
        }
        if ($("#trm_dia").val() == "") {
            alert("Debe ingresar el trm del dia", "Atencion!");
            $("#trm_dia").focus();
            return false;
        }
        if ($("#flete_usd").val() == "") {
            alert("Debe ingresar los valores de los fletes en dolares", "Atencion!");
            $("#flete_usd").focus();
            return false;
        }
        if ($("#flete_cop").val() == "") {
            alert("Debe ingresar los valores de los fletes nacionales en pesos", "Atencion!");
            $("#flete_cop").focus();
            return false;
        }
        if ($("#arancel").val() == "") {
            alert("Debe ingresar el valor del arancel", "Atencion!");
            $("#arancel").focus();
            return false;
        }
        if ($("#comision_banco_transf_exterior").val() == "") {
            alert("Debe ingresar la comision del banco", "Atencion!");
            $("#comision_banco_transf_exterior").focus();
            return false;
        }
        if ($("#nacionalizacion").val() == "") {
            alert("Debe ingresar el valor de la nacionalización", "Atencion!");
            $("#nacionalizacion").focus();
            return false;
        }
        if ($("#transportadora").val() == "") {
            alert("Debe ingresar el valor de la transportadora", "Atencion!");
            $("#transportadora").focus();
            return false;
        }

        alert("Valores de Calculo establecidos");
        $("#_rentabilidad").val($("#rentabilidad").val());
        $("#_costo_libra").val($("#costo_libra").val());
        $("#_trm_dia").val($("#trm_dia").val());
        $("#_flete_usd").val($("#flete_usd").val());
        $("#_flete_cop").val($("#flete_cop").val());
        $("#_arancel").val($("#arancel").val());
        $("#_comision_banco_transf_exterior").val($("#comision_banco_transf_exterior").val());
        $("#_nacionalizacion").val($("#nacionalizacion").val());
        $("#_transportadora").val($("#transportadora").val());
        $("#_haveCalc").val(true);
        $("#ModalCalc").modal("hide");
    });


    function vaciarInputsNewItem() {
        $("#providerName").val("");
        $("#_provider").val("");
        $("#marca").val("");
        $("#cantidad").val("");
        $("#referencia").val("");
        $("#descripcion").val("");
        $("#peso_unit_lbs").val("");
        $("#costo_unit_lbs").val("");
        $("#costo_unit_cop").val("");
        $("#dias_entrega").val("");
    }

    ////---------------------------------------------------
    //*****
    // INICIO FUNCIONES PARA MODALES DE CALCULO DE VALORES
    //*****
    ////
    $("#quote_provider_new_accept ").click(function(event) {

        if ($("#providerName").val() == "") {
            alert("Debe seleccionar el proveedor", "Atencion!");
            $("#providerName").focus();
            return false;
        }
        if ($("#marca").val() == "") {
            alert("Debe ingresar la marca", "Atencion!");
            $("#marca").focus();
            return false;
        }
        if ($("#cantidad").val() == "") {
            alert("Debe ingresar la cantidad", "Atencion!");
            $("#cantidad").focus();
            return false;
        }
        if ($("#referencia").val() == "") {
            alert("Debe ingresar la referencia", "Atencion!");
            $("#referencia").focus();
            return false;
        }
        if ($("#descripcion").val() == "") {
            alert("Debe ingresar la descripcion", "Atencion!");
            $("#descripcion").focus();
            return false;
        }
        if ($("#peso_unit_lbs").val() == "") {
            alert("Debe ingresar el peso unitario", "Atencion!");
            $("#peso_unit_lbs").focus();
            return false;
        }
        if ($("#costo_unit_lbs").val() == "") {
            alert("Debe ingresar el costo unitario", "Atencion!");
            $("#costo_unit_lbs").focus();
            return false;
        }
        if ($("#costo_unit_cop").val() == "") {
            alert("Debe ingresar el costo unitario COP", "Atencion!");
            $("#costo_unit_cop").focus();
            return false;
        }
        if ($("#dias_entrega").val() == "") {
            alert("Debe ingresar los días de entrega", "Atencion!");
            $("#dias_entrega").focus();
            return false;
        }


        let confirmacion = confirm("¿Esta seguro de agregar esta información?");
        if (confirmacion) {
            let tbody = document.getElementById("tbody_Qoute");
            let iterator_list = parseInt($("#iterator_qoute").val());
            let iterator_ultimate = 0;
            if (iterator_list > 0) {
                if (Finalarray.length != 0) {
                    iterator_ultimate = parseInt(Finalarray[Finalarray.length - 1]);
                    iterator_ultimate += 1;
                } else {
                    iterator_ultimate = iterator_list + 1;
                }
            }
            $("#tbody_Qoute").append(
                $('<tr id="reg_' + iterator_ultimate + '">').append(
                    $('<input type="hidden" id="num_provider_id_' + iterator_ultimate + '" value=' + $("#_provider").val() + '>'),
                    $('<td id="provider_' + iterator_ultimate + '" >').css('text-align', 'center').append($("#providerName").val())
                ).append(
                    $('<td id="marca_' + iterator_ultimate + '">').css('text-align', 'center').append($("#marca").val())
                ).append(
                    $('<td id="cantidad_' + iterator_ultimate + '">').css('text-align', 'center').append($("#cantidad").val())
                ).append(
                    $('<td id="referencia_' + iterator_ultimate + '">').css('text-align', 'center').append($("#referencia").val())
                ).append(
                    $('<td id="descripcion_' + iterator_ultimate + '">').css('text-align', 'center').append($("#descripcion").val())
                ).append(
                    $('<td id="peso_unit_lbs_' + iterator_ultimate + '">').css('text-align', 'center').append($("#peso_unit_lbs").val())
                ).append(
                    $('<td id="costo_unit_lbs_' + iterator_ultimate + '">').css('text-align', 'center').append($("#costo_unit_lbs").val())
                ).append(
                    $('<td id="costo_unit_cop_' + iterator_ultimate + '">').css('text-align', 'center').append($("#costo_unit_cop").val())
                ).append(
                    $('<td id="dias_entrega_' + iterator_ultimate + '">').css('text-align', 'center').append($("#dias_entrega").val())
                ).append(
                    $('<td>').css('text-align', 'center').append(
                        '<button type="button" onclick="drop(' + iterator_ultimate + ')" class="btn btn-danger default"> <i class="glyph-icon simple-icon-trash"></i></button>' +
                        '<button type="button" onclick="edit(' + iterator_ultimate + ')" class="btn btn-info default"> <i class="glyph-icon simple-icon-pencil"></i></button>'
                    )
                )
            );


            Finalarray.push(iterator_ultimate);
            $("#array_iterators").val(Finalarray)
            iterator_list += 1;
            $("#iterator_qoute").val(iterator_list);
            vaciarInputsNewItem();
            $("#ModalNewItem").modal('hide');
        }




        return false;

    })


    ////---------------------------------------------------
    //*****
    // INICIO FUNCIONES PARA SUBMIT TOTAL DE LA COTIZACIÓN
    //*****
    ////
    $("#add_qoute").on("submit", function() {

        let arrayItems = $("#array_iterators").val();

        //Validación si se establecio los valores de calculo
        let ValoresCalculoEstablecidos = $("#_haveCalc").val();
        if (ValoresCalculoEstablecidos == "true") {
            //Validación si existe el cliente
            let ExisteCliente = $("#id_client").val();
            if (ExisteCliente != "") {

                //****
                //Inicio de Validaciones con Datos completos
                //*****
                let opcion = confirm("Esta seguro de ingresar la cotización");
                if (opcion == true) {
                    listarItems();
                    $("#formulario_container").hide();
                    $("#previsualizacion_container").show();
                    return false;
                } else {
                    return false;
                }
                //****
                //Fin de Validaciones con Datos completos
                //*****

            } else {
                //Función para verificar si no hay valores de calculo 
                //establecidos y mostrar error y mostrar modal para ingresarlo
                $("#alert_client").show();
                selectClient();
                setTimeout(() => {
                    $("#alert_client").hide();
                }, 2000);
                return false;
            }
        } else {
            //Función para verificar si no hay valores de calculo 
            //establecidos y mostrar error y mostrar modal para ingresarlo
            $("#alert_val_calc").show();
            $("#ModalCalc").modal("show");
            setTimeout(() => {
                $("#alert_val_calc").hide();
            }, 2000);
            return false;
        }
    });

    function establecerDatosCotizacion(Finalarray, cant, ref, desc, marca, dias, precioVentaUnitarioXItem, precioVentaTotalXItem, precioGranTotalVenta, notas_cotizacion_export,nombre_cotizacion_export) {
        let name_client_print = $("#name_client").val();
        let ced_client_print = $("#cedula_client").val();
        let direc_client_print = $("#direc_client").val();
        let tel_client_print = $("#tel_client").val();
        $("#contact_client").html(name_client_print + "<br>" + ced_client_print + "<br>" + direc_client_print + "<br>" + tel_client_print);
        $("#contact_qoute").html("Previsualización <br> Sin asignar");
        let e = 0;
        let dara = "";
        let myPrecioVentaUnitarioXItem = "";
        let cuPrecioVentaUnitarioXItem = "";

        let myPrecioVentaTotalXItem = "";
        let cuPrecioVentaTotalXItem = "";

        Finalarray.forEach(function(elemento, indice, Finalarray) {
            e = indice + 1;
            myPrecioVentaUnitarioXItem = numeral(precioVentaUnitarioXItem[indice]);
            cuPrecioVentaUnitarioXItem = myPrecioVentaUnitarioXItem.format('$0,0.00');

            myPrecioVentaTotalXItem = numeral(precioVentaTotalXItem[indice]);
            cuPrecioVentaTotalXItem = myPrecioVentaTotalXItem.format('$0,0.00');

            dara += '<tr><td style="padding-top:0px; padding-bottom:5px;">';
            dara += '<p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;"> ' + e + '</p>';
            dara += '</td><td><p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">' + cant[indice] + ' </p>';
            dara += '</td><td>';
            dara += '<p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">' + ref[indice] + ' </p>';
            dara += '</td><td style="padding-top:0px; padding-bottom:0px;">';
            dara += ' <p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">' + desc[indice] + ' </p>';
            dara += '</td> <td> <p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;"> ' + marca[indice] + '</p>';
            dara += '</td> <td>';
            dara += '<p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">' + dias[indice] + ' </p>';
            dara += '</td><td>';
            dara += ' <p style="font-size: 13px; text-align: right; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;"> ' + cuPrecioVentaUnitarioXItem + '</p>';
            dara += '</td><td> <p style="font-size: 13px; text-align: right; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">' + cuPrecioVentaTotalXItem + ' </p>';
            dara += '</td></tr>';
            $("#content_items_qoute").html(dara);
        });

        let myPrecioVentaSubTotal = numeral(precioGranTotalVenta);
        let cuPrecioVentaSubTotal = myPrecioVentaSubTotal.format('$0,0.00');
        $("#SubtotalPrev").html(cuPrecioVentaSubTotal);

        let valIvaSubtotal = parseFloat(precioGranTotalVenta) * 0.19;
        valIvaSubtotal = valIvaSubtotal.toFixed(2);
        convertedValIvaSubtotal = numeral(valIvaSubtotal);
        $("#valIvaSubtotal").html(convertedValIvaSubtotal.format('$0,0.00'));

        let totalCotizacion = parseFloat(precioGranTotalVenta) + parseFloat(valIvaSubtotal);
        let printNumerosLetras = NumeroALetras(totalCotizacion);
        $("#numerosLetras").html(printNumerosLetras);
        totalCotizacion = numeral(totalCotizacion);
        let printTotalCotizacion = totalCotizacion.format('$0,0.00');
        $("#totalCotizacion").html(printTotalCotizacion);
    }

    function listarItems() {
        'use strict';

        let prov = [];
        let marca = [];
        let cant = [];
        let ref = [];
        let desc = [];
        let peso = [];
        let cosl = [];
        let cosc = [];
        let dias = [];

        //Variables de Calculo Usuario
        let rentabilidad_calc = $("#_rentabilidad").val();
        let costo_libra_calc = $("#_costo_libra").val();
        let trm_dia_calc = $("#_trm_dia").val();
        let flete_usd_calc = $("#_flete_usd").val();
        let flete_cop_calc = $("#_flete_cop").val();
        let arancel_calc = $("#_arancel").val();
        let comision_banco_transf_exterior_calc = $("#_comision_banco_transf_exterior").val();
        let nacionalizacion_calc = $("#_nacionalizacion").val();
        let transportadora_calc = $("#transportadora").val();



        //Varibales de calculo interno
        let porcPeso = [];


        let pesoTotalXItem = [];

        Finalarray.forEach(function(elemento, indice, Finalarray) {
            prov[indice] = $("#provider_" + elemento).text();
            marca[indice] = $("#marca_" + elemento).text();
            cant[indice] = parseFloat($("#cantidad_" + elemento).text());
            ref[indice] = $("#referencia_" + elemento).text();
            desc[indice] = $("#descripcion_" + elemento).text();
            peso[indice] = parseFloat($("#peso_unit_lbs_" + elemento).text());
            cosl[indice] = parseFloat($("#costo_unit_lbs_" + elemento).text());
            cosc[indice] = parseFloat($("#costo_unit_cop_" + elemento).text());
            dias[indice] = parseFloat($("#dias_entrega_" + elemento).text());
            pesoTotalXItem.push(cant[indice] * peso[indice]);
        });



        //
        //Suma Peso Total  
        // var @sumaPesoTotal
        let sumaPesoTotal = 0;
        pesoTotalXItem.forEach(function(elemento, indice, Finalarray) {
            sumaPesoTotal += parseFloat(elemento);
        });

        //Fin Suma Peso Total 
        //Variable Costo Total por peso
        //  costoTotalXPeso
        costo_libra_calc = parseFloat(costo_libra_calc);
        let costoTotalXPeso = costo_libra_calc * sumaPesoTotal;
        costoTotalXPeso = costoTotalXPeso.toFixed(2);


        let porcPesoXItem = [];
        let num = 0;
        Finalarray.forEach(function(elemento, indice, Finalarray) {
            num = pesoTotalXItem[indice] / sumaPesoTotal;
            porcPesoXItem[indice] = num.toFixed(2);
            num = 0;
        });


        let costoTotalAntePeso = [];
        Finalarray.forEach(function(elemento, indice, Finalarray) {
            costoTotalAntePeso[indice] = cant[indice] * cosl[indice];
        });


        let costoValorImportXPeso = [];
        Finalarray.forEach(function(elemento, indice, Finalarray) {
            costoValorImportXPeso[indice] = porcPesoXItem[indice] * costoTotalXPeso;
            costoValorImportXPeso[indice] = costoValorImportXPeso[indice].toFixed(1);
        });


        let costoValFleteInternoIntUSD = [];
        Finalarray.forEach(function(elemento, indice, Finalarray) {
            costoValFleteInternoIntUSD[indice] = porcPesoXItem[indice] * parseFloat(flete_usd_calc);
        });


        let CostoTotal = [];
        Finalarray.forEach(function(elemento, indice, Finalarray) {
            CostoTotal[indice] = ((parseFloat(costoValorImportXPeso[indice]) + costoTotalAntePeso[indice]) * (1 + (arancel_calc / 100))).toFixed(3);
        });



        //Variable que se debe editar del dolar real de calculos 
        //para ser alimentado por modulos
        //Debe editarse desde modulo y traer con json
        function RoundTo(number, roundto) {
            return roundto * Math.round(number / roundto);
        }
        let porcDolarProyectado = 1.1448;
        let dolarRealCalcAux = parseFloat(trm_dia_calc) * porcDolarProyectado;
        let dolarRealCalc = RoundTo(dolarRealCalcAux, 50);

        let CostoTotalPesosPartsImpor = [];

        Finalarray.forEach(function(elemento, indice, Finalarray) {
            CostoTotalPesosPartsImpor[indice] = CostoTotal[indice] * dolarRealCalc;
        });


        let costoTotalEnPesos = [];
        Finalarray.forEach(function(elemento, indice, Finalarray) {
            costoTotalEnPesos[indice] = cant[indice] * cosc[indice];
        });




        //
        //Inicio Totales 
        //
        let costoTotalPartes = 0;
        costoTotalAntePeso.forEach(function(elemento, indice, Finalarray) {
            costoTotalPartes += elemento;
        });

        let costoTotalPFN = 0;
        CostoTotal.forEach(function(elemento, indice, Finalarray) {
            costoTotalPFN += parseFloat(elemento);
        });
        //next
        let costoTotalSinAdc = 0;
        let GranTotalEnPesosPartsImport = 0;
        let GranTotalCostoPesos = 0;

        CostoTotalPesosPartsImpor.forEach(function(elemento, indice, Finalarray) {
            GranTotalEnPesosPartsImport += elemento;
        });

        costoTotalEnPesos.forEach(function(elemento, indice, Finalarray) {
            GranTotalCostoPesos += elemento;
        });

        // COSTO TOTAL EN PESOS ANTES SIN ADICIONALES 
        costoTotalSinAdc = GranTotalEnPesosPartsImport + GranTotalCostoPesos;

        //
        //Fin Totales 
        //

        let CostoUnitPesosPartsImpor = [];
        Finalarray.forEach(function(elemento, indice, Finalarray) {
            CostoUnitPesosPartsImpor[indice] = CostoTotalPesosPartsImpor[indice] / cant[indice];
            CostoUnitPesosPartsImpor[indice] = CostoUnitPesosPartsImpor[indice].toFixed(2);
        });


        let PorcPesosAcuerdoPesos = [];

        CostoTotalPesosPartsImpor.forEach(function(elemento, indice, Finalarray) {
            let aux = elemento / costoTotalSinAdc;
            if (aux > 0) {
                PorcPesosAcuerdoPesos[indice] = aux;
            } else {
                let cond = costoTotalEnPesos[indice] / costoTotalSinAdc;
                PorcPesosAcuerdoPesos[indice] = cond;
            }
            PorcPesosAcuerdoPesos[indice] = PorcPesosAcuerdoPesos[indice];
        });




        //panel
        let Res_costoGranTotalPesosconAdc = 0;
        Res_costoGranTotalPesosconAdc = (GranTotalEnPesosPartsImport + GranTotalCostoPesos) + parseFloat(flete_cop_calc) + parseFloat(nacionalizacion_calc) + parseFloat(transportadora_calc) + ((parseFloat(flete_usd_calc) + parseFloat(comision_banco_transf_exterior_calc)) * dolarRealCalc)


        //COSTO TOTAL EN PESOS IMPORTACION MAS NACIONAL

        let costoTotalPesosImporMasNal = [];
        Finalarray.forEach(function(elemento, indice, Finalarray) {
            let numAuxcostoTotalPesosImporMasNal = PorcPesosAcuerdoPesos[indice] * Res_costoGranTotalPesosconAdc;
            costoTotalPesosImporMasNal[indice] = numAuxcostoTotalPesosImporMasNal.toFixed(2);
        });


        //Precios de Venta

        //Venta Total
        let precioVentaTotalXItem = [];
        costoTotalPesosImporMasNal.forEach(function(elemento, indice, Finalarray) {
            let numAuxprecioVentaTotalXItem = parseFloat(elemento) * ((100 / (100 - parseFloat(rentabilidad_calc))));
            numAuxprecioVentaTotalXItem = RoundTo(numAuxprecioVentaTotalXItem, 100);
            precioVentaTotalXItem[indice] = numAuxprecioVentaTotalXItem.toFixed(2);
        });


        //Venta Unitaria
        let precioVentaUnitarioXItem = [];

        precioVentaTotalXItem.forEach(function(elemento, indice, Finalarray) {
            let numAuxprecioVentaTotalXItem = elemento / cant[indice];
            precioVentaUnitarioXItem[indice] = numAuxprecioVentaTotalXItem.toFixed(2);
        });



        //PRECIO DE VENTA TOTAL

        let precioGranTotalVenta = 0;
        precioVentaTotalXItem.forEach(function(elemento, indice, Finalarray) {
            precioGranTotalVenta = precioGranTotalVenta + parseFloat(elemento);
        });


        let rentabilidadFinal = 0;
        rentabilidadFinal = parseFloat(precioGranTotalVenta - Res_costoGranTotalPesosconAdc).toFixed(2);


        let rentabilidadFinalPorc = 0;
        rentabilidadFinalPorc = ((1 - (Res_costoGranTotalPesosconAdc / precioGranTotalVenta)) * 100).toFixed(0);



        $("#label_app_menu_rent").html("%" + rentabilidad_calc);
        $("#label_app_menu_costo").html("$" + costo_libra_calc);
        $("#label_app_menu_trm").html("$" + trm_dia_calc);
        $("#label_app_menu_fleteusd").html("$" + flete_usd_calc);
        $("#label_app_menu_fletecop").html("$" + flete_cop_calc);
        $("#label_app_menu_aranc").html("%" + arancel_calc);
        $("#label_app_menu_comision").html("$" + comision_banco_transf_exterior_calc);
        $("#label_app_menu_nacionaliza").html("$" + nacionalizacion_calc);
        $("#label_app_menu_transport").html("$" + transportadora_calc);

        let client_id = $("#id_client").val();

        let valIvaSubtotal = parseFloat(precioGranTotalVenta) * 0.19;
        valIvaSubtotal = valIvaSubtotal.toFixed(2);

        let totalCotizacion = parseFloat(precioGranTotalVenta) + parseFloat(valIvaSubtotal);

        let notas_cotizacion_export = $("#notas_cotizacion").val();
        $("#export_notas").val(notas_cotizacion_export);
        let nombre_cotizacion_export = $("#nombre_cotizacion").val();
        $("#export_nombre").val(nombre_cotizacion_export);
        
        fillExport(Finalarray, prov, marca, cant, ref, desc, peso, cosl, cosc, dias, rentabilidad_calc, costo_libra_calc, trm_dia_calc, flete_usd_calc, flete_cop_calc, arancel_calc, comision_banco_transf_exterior_calc, nacionalizacion_calc, transportadora_calc, porcPeso, pesoTotalXItem, sumaPesoTotal, costo_libra_calc, costoTotalXPeso, porcPesoXItem, costoTotalAntePeso, costoValorImportXPeso, costoValFleteInternoIntUSD, CostoTotal, CostoTotalPesosPartsImpor, costoTotalEnPesos, costoTotalPartes, costoTotalPFN, costoTotalSinAdc, GranTotalEnPesosPartsImport, GranTotalCostoPesos, CostoUnitPesosPartsImpor, PorcPesosAcuerdoPesos, Res_costoGranTotalPesosconAdc, costoTotalPesosImporMasNal, precioVentaTotalXItem, precioVentaUnitarioXItem, precioGranTotalVenta, rentabilidadFinal, rentabilidadFinalPorc, dolarRealCalc, client_id, valIvaSubtotal, totalCotizacion);
        establecerDatosCotizacion(Finalarray, cant, ref, desc, marca, dias, precioVentaUnitarioXItem, precioVentaTotalXItem, precioGranTotalVenta, notas_cotizacion_export,nombre_cotizacion_export);

        return false;

    }

    function fillExport(Finalarray, prov, marca, cant, ref, desc, peso, cosl, cosc, dias, rentabilidad_calc, costo_libra_calc, trm_dia_calc, flete_usd_calc, flete_cop_calc, arancel_calc, comision_banco_transf_exterior_calc, nacionalizacion_calc, transportadora_calc, porcPeso, pesoTotalXItem, sumaPesoTotal, costo_libra_calc, costoTotalXPeso, porcPesoXItem, costoTotalAntePeso, costoValorImportXPeso, costoValFleteInternoIntUSD, CostoTotal, CostoTotalPesosPartsImpor, costoTotalEnPesos, costoTotalPartes, costoTotalPFN, costoTotalSinAdc, GranTotalEnPesosPartsImport, GranTotalCostoPesos, CostoUnitPesosPartsImpor, PorcPesosAcuerdoPesos, Res_costoGranTotalPesosconAdc, costoTotalPesosImporMasNal, precioVentaTotalXItem, precioVentaUnitarioXItem, precioGranTotalVenta, rentabilidadFinal, rentabilidadFinalPorc, dolarRealCalc, client_id, iva_final, gran_total) {
        $("#export_array").val(Finalarray);
        $("#export_prov").val(prov);
        $("#export_marca").val(marca);
        $("#export_cant").val(cant);
        $("#export_ref").val(ref);
        $("#export_desc").val(desc);
        $("#export_peso").val(peso);
        $("#export_cosl").val(cosl);
        $("#export_cosc").val(cosc);
        $("#export_dias").val(dias);
        $("#export_rentabilidad_calc").val(rentabilidad_calc);
        $("#export_costo_libra_calc").val(costo_libra_calc);
        $("#export_trm_dia_calc").val(trm_dia_calc);
        $("#export_flete_usd_calc").val(flete_usd_calc);
        $("#export_flete_cop_calc").val(flete_cop_calc);
        $("#export_arancel_calc").val(arancel_calc);
        $("#export_comision_banco_transf_exterior_calc").val(comision_banco_transf_exterior_calc);
        $("#export_nacionalizacion_calc").val(nacionalizacion_calc);
        $("#export_transportadora_calc").val(transportadora_calc);
        $("#export_porcPeso").val(porcPeso);
        $("#export_pesoTotalXItem").val(pesoTotalXItem);
        $("#export_sumaPesoTotal").val(sumaPesoTotal);
        $("#export_costo_libra_calc").val(costo_libra_calc);
        $("#export_costoTotalXPeso").val(costoTotalXPeso);
        $("#export_porcPesoXItem").val(porcPesoXItem);
        $("#export_costoTotalAntePeso").val(costoTotalAntePeso);
        $("#export_costoValorImportXPeso").val(costoValorImportXPeso);
        $("#export_costoValFleteInternoIntUSD").val(costoValFleteInternoIntUSD);
        $("#export_CostoTotal").val(CostoTotal);
        $("#export_CostoTotalPesosPartsImpor").val(CostoTotalPesosPartsImpor);
        $("#export_costoTotalEnPesos").val(costoTotalEnPesos);
        $("#export_costoTotalPartes").val(costoTotalPartes);
        $("#export_costoTotalPFN").val(costoTotalPFN);
        $("#export_costoTotalSinAdc").val(costoTotalSinAdc);
        $("#export_GranTotalEnPesosPartsImport").val(GranTotalEnPesosPartsImport);
        $("#export_GranTotalCostoPesos").val(GranTotalCostoPesos);
        $("#export_CostoUnitPesosPartsImpor").val(CostoUnitPesosPartsImpor);
        $("#export_PorcPesosAcuerdoPesos").val(PorcPesosAcuerdoPesos);
        $("#export_Res_costoGranTotalPesosconAdc").val(Res_costoGranTotalPesosconAdc);
        $("#export_costoTotalPesosImporMasNal").val(costoTotalPesosImporMasNal);
        $("#export_precioVentaTotalXItem").val(precioVentaTotalXItem);
        $("#export_precioVentaUnitarioXItem").val(precioVentaUnitarioXItem);
        $("#export_precioGranTotalVenta").val(precioGranTotalVenta);
        $("#export_rentabilidadFinal").val(rentabilidadFinal);
        $("#export_rentabilidadFinalPorc").val(rentabilidadFinalPorc);
        $("#export_dolarRealCalc").val(dolarRealCalc);

        $("#export_client_id").val(client_id);
        $("#export_ivaFinal").val(iva_final);
        $("#export_Gran_Total").val(gran_total);
    }

    function Unidades(num) {

        switch (num) {
            case 1:
                return "UN";
            case 2:
                return "DOS";
            case 3:
                return "TRES";
            case 4:
                return "CUATRO";
            case 5:
                return "CINCO";
            case 6:
                return "SEIS";
            case 7:
                return "SIETE";
            case 8:
                return "OCHO";
            case 9:
                return "NUEVE";
        }

        return "";
    } //Unidades()

    function Decenas(num) {

        decena = Math.floor(num / 10);
        unidad = num - (decena * 10);

        switch (decena) {
            case 1:
                switch (unidad) {
                    case 0:
                        return "DIEZ";
                    case 1:
                        return "ONCE";
                    case 2:
                        return "DOCE";
                    case 3:
                        return "TRECE";
                    case 4:
                        return "CATORCE";
                    case 5:
                        return "QUINCE";
                    default:
                        return "DIECI" + Unidades(unidad);
                }
            case 2:
                switch (unidad) {
                    case 0:
                        return "VEINTE";
                    default:
                        return "VEINTI" + Unidades(unidad);
                }
            case 3:
                return DecenasY("TREINTA", unidad);
            case 4:
                return DecenasY("CUARENTA", unidad);
            case 5:
                return DecenasY("CINCUENTA", unidad);
            case 6:
                return DecenasY("SESENTA", unidad);
            case 7:
                return DecenasY("SETENTA", unidad);
            case 8:
                return DecenasY("OCHENTA", unidad);
            case 9:
                return DecenasY("NOVENTA", unidad);
            case 0:
                return Unidades(unidad);
        }
    } //Unidades()

    function DecenasY(strSin, numUnidades) {
        if (numUnidades > 0)
            return strSin + " Y " + Unidades(numUnidades)

        return strSin;
    } //DecenasY()

    function Centenas(num) {
        centenas = Math.floor(num / 100);
        decenas = num - (centenas * 100);

        switch (centenas) {
            case 1:
                if (decenas > 0)
                    return "CIENTO " + Decenas(decenas);
                return "CIEN";
            case 2:
                return "DOSCIENTOS " + Decenas(decenas);
            case 3:
                return "TRESCIENTOS " + Decenas(decenas);
            case 4:
                return "CUATROCIENTOS " + Decenas(decenas);
            case 5:
                return "QUINIENTOS " + Decenas(decenas);
            case 6:
                return "SEISCIENTOS " + Decenas(decenas);
            case 7:
                return "SETECIENTOS " + Decenas(decenas);
            case 8:
                return "OCHOCIENTOS " + Decenas(decenas);
            case 9:
                return "NOVECIENTOS " + Decenas(decenas);
        }

        return Decenas(decenas);
    } //Centenas()

    function Seccion(num, divisor, strSingular, strPlural) {
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)

        letras = "";

        if (cientos > 0)
            if (cientos > 1)
                letras = Centenas(cientos) + " " + strPlural;
            else
                letras = strSingular;

        if (resto > 0)
            letras += "";

        return letras;
    } //Seccion()

    function Miles(num) {
        divisor = 1000;
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)

        strMiles = Seccion(num, divisor, "UN MIL", "MIL");
        strCentenas = Centenas(resto);

        if (strMiles == "")
            return strCentenas;

        return strMiles + " " + strCentenas;
    } //Miles()

    function Millones(num) {
        divisor = 1000000;
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)

        strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
        strMiles = Miles(resto);

        if (strMillones == "")
            return strMiles;

        return strMillones + " " + strMiles;
    } //Millones()

    function NumeroALetras(num) {
        var data = {
            numero: num,
            enteros: Math.floor(num),
            centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
            letrasCentavos: "",
            letrasMonedaPlural: 'PESOS', //"PESOS", 'Dólares', 'Bolívares', 'etcs'
            letrasMonedaSingular: 'PESO', //"PESO", 'Dólar', 'Bolivar', 'etc'

            letrasMonedaCentavoPlural: "CENTAVOS",
            letrasMonedaCentavoSingular: "CENTAVO"
        };

        if (data.centavos > 0) {
            data.letrasCentavos = "CON " + (function() {
                if (data.centavos == 1)
                    return Millones(data.centavos) + " " + data.letrasMonedaCentavoSingular;
                else
                    return Millones(data.centavos) + " " + data.letrasMonedaCentavoPlural;
            })();
        };

        if (data.enteros == 0)
            return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
        if (data.enteros == 1)
            return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
        else
            return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
    } //NumeroALetras()



    function back() {
        $("#formulario_container").show();
        $("#previsualizacion_container").hide();
    }

    function Submit_qoute() {
        let opcion = confirm("¿Esta seguro de actualizar la cotización? Se asignara un consecutivo adicional.")
        if (opcion == true) {
            let data = $('#main-form').serialize();
            $.ajax({
                url: $('#main-form #_url').val(),
                headers: {
                    'X-CSRF-TOKEN': $('#main-form #_token').val()
                },
                type: 'PUT',
                cache: false,
                data: data,
                success: function(response) {
                    var json = $.parseJSON(response);
                    if (json.success) {
                        alert("Registro editado correctamente");
                        window.location.replace("/cotizacion");
                    } else {
                        alert("Ha ocurrido un error");
                        return false;
                    }
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    $.each(errors.errors, function(key, value) {
                        alert(value);
                        return false;
                    });
                }
            });
        } else {
            return false;
        }


    }
</script>
@endpush