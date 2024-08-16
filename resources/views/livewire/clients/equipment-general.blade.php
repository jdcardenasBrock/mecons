<div>
    <div class="mb-2">
        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">
            Display Options
            <i class="simple-icon-arrow-down align-middle"></i>
        </a>
        <div class="collapse d-md-block" id="displayOptions">
            <span class="mr-3 mb-2 d-inline-block float-md-left">
                <a href="#" class="mr-2 view-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                        <path class="view-icon-svg" d="M17.5,3H.5a.5.5,0,0,1,0-1h17a.5.5,0,0,1,0,1Z"></path>
                        <path class="view-icon-svg" d="M17.5,10H.5a.5.5,0,0,1,0-1h17a.5.5,0,0,1,0,1Z"></path>
                        <path class="view-icon-svg" d="M17.5,17H.5a.5.5,0,0,1,0-1h17a.5.5,0,0,1,0,1Z"></path>
                    </svg>
                </a>
                <a href="#" class="mr-2 view-icon active">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                        <path class="view-icon-svg" d="M17.5,3H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z"></path>
                        <path class="view-icon-svg" d="M3,2V3H1V2H3m.12-1H.88A.87.87,0,0,0,0,1.88V3.12A.87.87,0,0,0,.88,4H3.12A.87.87,0,0,0,4,3.12V1.88A.87.87,0,0,0,3.12,1Z"></path>
                        <path class="view-icon-svg" d="M3,9v1H1V9H3m.12-1H.88A.87.87,0,0,0,0,8.88v1.24A.87.87,0,0,0,.88,11H3.12A.87.87,0,0,0,4,10.12V8.88A.87.87,0,0,0,3.12,8Z"></path>
                        <path class="view-icon-svg" d="M3,16v1H1V16H3m.12-1H.88a.87.87,0,0,0-.88.88v1.24A.87.87,0,0,0,.88,18H3.12A.87.87,0,0,0,4,17.12V15.88A.87.87,0,0,0,3.12,15Z"></path>
                        <path class="view-icon-svg" d="M17.5,10H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z"></path>
                        <path class="view-icon-svg" d="M17.5,17H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z"></path>
                    </svg>
                </a>
            </span>
            <div class="d-block d-md-inline-block">
                <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                    <input placeholder="Buscar..." wire:model.debounce.300ms="search">
                </div>
            </div>
            <div class="float-md-right">
                <select class="btn btn-outline-secondary  btn-xs dropdown-toggle" wire:model="perPage">
                    <option class="dropdown-item" value="10">10</option>
                    <option class="dropdown-item" value="20">20</option>
                    <option class="dropdown-item" value="50">50</option>
                </select>
            </div>
        </div>
    </div>
    @foreach ($items->groupBy('id_cliente') as $cliente => $equipos)
    <div class="row">
        <div class="col-12 list">
            <div class="card d-flex flex-row mb-3 bg-body" style="height: 50px;background-color: gainsboro;">
                <div class="d-flex flex-grow-1 min-width-zero">
                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                        <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="#">

                            <i class="glyph-icon simple-icon-user heading-icon"></i>
                            <span class="align-middle d-inline-block"> <b>Cliente: </b>{{$equipos->first()->client->name}}</span>

                        </a>
                    </div>
                </div>
            </div>
            @foreach ($equipos as $equipo)
            <div class="card d-flex flex-row mb-3" style="margin-left: 12px;">
                <div class="d-flex flex-grow-1 min-width-zero">
                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                        <a class="list-item-heading mb-0 truncate w-40 w-xs-100" href="#">
                            <i class="glyph-icon iconsminds-tractor"></i>
                            <span class="align-middle d-inline-block">{{ucfirst($equipo->marca)}}</span>
                        </a>
                        <p class="mb-0 w-15 w-xs-100"> {{ucfirst($equipo->nombre_modelo)}} </p>
                        <p class="mb-0 w-15 w-xs-100"> {{ucfirst($equipo->modelo)}} </p>
                        <p class="mb-0 w-15 w-xs-100"> {{ucfirst($equipo->serial)}} </p>
                        <p class="mb-0 w-15 w-xs-100"> {{ucfirst($equipo->numero_interno)}} </p>
                        <div class="w-15 w-xs-100">
                            <span class="badge badge-pill badge-secondary">{{ucfirst($equipo->ubicacion)}}</span>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    @endforeach

        <nav class="mt-4  mb-3">
            {{ $items->links() }}
        </nav>



</div>