@extends('layouts.app_page')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Gestion del Proyecto </h1>
            </div>

            <div class="separator mb-5"></div>
          
            <livewire:construction.project-costs :project_id="$project_id"/>
        </div>
    </div>
</div>

@endsection