@extends('layouts.app_page')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Detalle de {{$client->name}}</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                {{$client->typeID}}: {{$client->numID}}
                            </li>
                            <li class="breadcrumb-item">
                            Telefono: {{$client->telefono}}
                            </li>
                        </ol>
                    </nav>
            </div>
            <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="equipments-tab" data-toggle="tab" href="#equipment" role="tab" aria-controls="equipment" aria-selected="true">EQUIPOS</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">CONTACTOS</a>
                </li>
            </ul>
            <div class="tab-content mb-4">
                <div class="tab-pane show active" id="equipment" role="tabpanel" aria-labelledby="equipments-tab">
                    <livewire:clients.equipments :idCliente="$id"/>
                </div>

                <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    <livewire:clients.contacts :idCliente="$id"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection