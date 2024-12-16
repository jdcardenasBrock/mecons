@extends('layouts.app_page')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Modulo Subtareas</h1>
            </div>

            <div class="separator mb-5"></div>
          
            <livewire:crm.new-subtask :taskId="$taskId"/>
        </div>
    </div>
</div>
@endsection