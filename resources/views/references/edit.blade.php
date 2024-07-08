<div class="dropdown d-inline-block">
        <button class="btn btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButtonUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opciones
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonUser" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
            
            <a class="dropdown-item" onclick="show(this)" id=" {{$id }}">Ver Nota</a>   
            @can('asignar_referencia')
            <a class="dropdown-item" onclick="assign(this)" id="{{$id}}">Asignar</a>
            @endcan 
            @can('editar_referencia')
            <a class="dropdown-item" onclick="edit(this)" id="{{$id}}">Editar</a>
            @endcan
            @can('eliminar_referencia')
            <a class="dropdown-item" onclick="drop(this)" id="{{$id}}">Eliminar</a>
            @endcan
        </div>
    </div>