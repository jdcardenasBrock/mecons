<div class="dropdown d-inline-block">
        <button class="btn btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButtonProvider" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opciones
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonProvider" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
            @can('editar_proveedor')
            <a class="dropdown-item" onclick="edit(this)" id="{{$id}}">Editar</a>
            @endcan
            @can('eliminar_proveedor')
            <a class="dropdown-item" onclick="drop(this)" id="{{$id}}">Eliminar</a>
            @endcan
        </div>
    </div>