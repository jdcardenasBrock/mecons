@extends('layouts.app_page')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Listado de Tareas</h1>
            </div>

            <div class="separator mb-5"></div>
          
            <livewire:crm.task-list />
        </div>
    </div>
</div>
@endsection