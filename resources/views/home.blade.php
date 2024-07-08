@extends('layouts.app_dash')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Dashboard</h1>
               
                <div class="separator mb-5"></div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6 col-12 mb-4">
                <a href="#"  onclick="MostrarModulo('repuestos')">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body text-center">
                            <img class="card-img-top" style="width:240px;" src="{{asset('img/dashboard/Tools.png')}}" alt="Card image cap">
                            
                            <p class="card-text mb-0">Repuestos</p>
                            <h3 class="text-center">Mostrar Modulos</h3>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-12 mb-4">

                <a href="#"  onclick="MostrarModulo('constructor')">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body text-center">
                                <img class="card-img-top" style="width:240px;" src="{{asset('img/dashboard/Grua.png')}}" alt="Card image cap">
                                
                                <p class="card-text mb-0">Construcción</p>
                                <h3 class="text-center" >Mostrar Modulos</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
   
        <div class="row sortable" id="modulo_respuestos" style="display: none">
            <div class="row sortable">
                <div class="col-xl-2 col-lg-2 mb-4">
                    <a href="{{url('references')}}" class="card">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Modulo Maestro <br>de Referencias</h6>
                                <span class="badge badge-pill badge-outline-primary mb-1">Ir</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-lg-2 mb-4">
                    <a href="{{url('cotizacion')}}" class="card">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Modulo <br>Cotizador</h6>
                                <span class="badge badge-pill badge-outline-primary mb-1">Ir</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-lg-2 mb-4">
                    <a href="{{url('references')}}" class="card">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">

                                <h6 class="mb-0">Modulo <br>Pedidos</h6>
                                <span class="badge badge-pill badge-outline-primary mb-1">Ir</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-lg-2 mb-4">
                    <a href="{{url('clients')}}" class="card">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">

                                <h6 class="mb-0">Modulo <br>Clientes</h6>
                                <span class="badge badge-pill badge-outline-primary mb-1">Ir</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-lg-2 mb-4">
                    <a href="{{url('proveedores')}}" class="card">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Modulo <br>Proveedores</h6>
                                <span class="badge badge-pill badge-outline-primary mb-1">Ir</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row sortable" id="modulo_construccion" style="display: none">
            Area en Construccion
        </div>



    </div>
    
@endsection
@push("scripts")
    <script>
        function MostrarModulo(opt){

            let divModuleRepuestos=document.getElementById("modulo_respuestos");
            let divModuleConstructor=document.getElementById("modulo_construccion");
            if(opt=="constructor"){
                divModuleRepuestos.style.display="none";
                divModuleConstructor.style.display="block";
            }else if(opt=="repuestos"){
                divModuleRepuestos.style.display="block";
                divModuleConstructor.style.display="none";
            }else{
                divModuleRepuestos.style.display="none";
                divModuleConstructor.style.display="none";
            }
        }
    </script>
@endpush

