@extends('layouts.app_page')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Maestro de Proyectos</h1>
                
                <div class="top-right-button-container">
                    <a href="{{route('add_project')}}">
                    <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1">Agregar Nuevo Proyecto</button></a>
                </div>
            </div>

            <div class="separator mb-5"></div>
          
            <livewire:construction.project-list/>
        </div>
    </div>
</div>
@endsection