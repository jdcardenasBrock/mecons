@extends('layouts.app_page')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Modulo CRM</h1>
            </div>

            <div class="separator mb-5"></div>
          
            <livewire:add-marca-modelos/>
        </div>
    </div>
</div>
@endsection