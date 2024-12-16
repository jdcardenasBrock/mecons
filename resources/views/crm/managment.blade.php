@extends('layouts.app_page')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Modulo CRM</h1>

                <div class="top-right-button-container">
                </div>
            </div>

            <div class="separator mb-5"></div>

            <div class="row">
                <div class="col-lg-6 col-12 mb-4">
                    <a href="{{route('new_task')}}">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="card-img-top" style="width:150px;" src="{{asset('img/list.png')}}" alt="Card image cap">
                                <h5 class="card-title mt-4 "><b>Agregar Nueva Tarea</b></h5>

                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-12 mb-4">

                    <a href="{{route('task_list')}}">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="card-img-top" style="width:150px;" src="{{asset('img/task.png')}}" alt="Card image cap">
                                <h5 class="card-title mt-4 "><b>Ver Listado de Tareas</b></h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection