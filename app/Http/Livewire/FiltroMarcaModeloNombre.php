<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Marca;
use App\Models\marcas;
use App\Models\Modelo;
use App\Models\modelos;
use App\Models\nombre_modelos;
use App\Models\NombreModelo;

class FiltroMarcaModeloNombre extends Component
{
    public $marcas;
    public $modelos = [];
    public $nombres = [];
    public $marcaSeleccionada;
    public $modeloSeleccionado;
    public $modeloSelect;


    public $marcaNombre;
    public $modeloNombre;

    public function mount()
    {
        $this->marcas = marcas::all();
    }
    protected $listeners = ['dataRefreshed' => 'reloadData'];

    public function reloadData($marcaId, $modeloId)
    {
        // Recargar los datos de las marcas, modelos y nombres
        $this->marcas = marcas::all();
        $this->modelos = modelos::all();

        // Establecer la marca seleccionada
        $marca = marcas::where('id',$marcaId)->first();
        if ($marca) {
            $this->marcaNombre = $marca->id;
        }
        if ($modeloId) {
            $this->modeloNombre = $modeloId;
            $this->nombres = nombre_modelos::where('modelo_id',$modeloId)->get();
        }
    }

    public function selectOption($option, $id)
    {
        if ($option === 'marca') {
            // Cuando se selecciona una marca, limpia el modelo y los nombres
            $this->modeloSeleccionado = null;
            $this->nombres = [];
            
            // Filtra los modelos según la marca seleccionada
            $this->modelos = modelos::where('marca_id', $id)->get();
        }
    
        if ($option === 'modelo') {
            $this->nombres = nombre_modelos::where('modelo_id', $id)->get();
        }
    }
    

    public function render()
    {
        return view('livewire.filtro-marca-modelo-nombre');
    }
}
