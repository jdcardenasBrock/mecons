<?php

namespace App\Http\Livewire;

use App\Models\marcas;
use App\Models\modelos;
use App\Models\nombre_modelos;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddMarcaModelos extends Component
{
    public $marcaNombre;
    public $modelos = []; // Modelos que se agregarán
    public $nombres = []; // Nombres de modelos por cada modelo

    public $dataEquipment;
    public $usarSelectMarca = true;
    public $usarSelect = true;
    public $marcasExistentes = [];
    public $modelosExistentes = [];
    public $nombresExistentes = [];


    public function mount()
    {
        $this->modelos[] = ['nombre' => '', 'usarSelect' => true, 'nombres' => []];
        $this->marcasExistentes = marcas::all();
        $this->nombresExistentes = nombre_modelos::all();
        $this->modelosExistentes = [];
    }
    public function reloadData()
    {
        $this->marcasExistentes = marcas::all();
        $modeloId=marcas::where('nombre',$this->marcaNombre)->first();
        $this->modelosExistentes = modelos::where('marca_id',$modeloId->id)->get();
         $this->nombresExistentes =[];
    }


    public function addModelo()
    {
        $this->modelos[] = ['nombre' => '', 'usarSelect' => true, 'nombres' => [['nombre' => '']]];
    }

    public function addNombre($index)
    {
        $this->modelos[$index]['nombres'][] = ['nombre' => ''];
    }

    public function removeModelo($index)
    {
        unset($this->modelos[$index]);
        $this->modelos = array_values($this->modelos); // Reindexar
    }

    public function removeNombre($modeloIndex, $nombreIndex)
    {
        unset($this->modelos[$modeloIndex]['nombres'][$nombreIndex]);
        $this->modelos[$modeloIndex]['nombres'] = array_values($this->modelos[$modeloIndex]['nombres']);
    }


    public function updatedMarcaNombre($value)
    {
        // Filtrar modelos basados en la marca seleccionada
        if ($value) {
            $marca = marcas::where('nombre', $value)->first();
            $this->modelosExistentes = $marca ? modelos::where('marca_id', $marca->id)->get() : [];
        } else {
            $this->modelosExistentes = [];
        }
    }

    public function save()
    {
        $this->validate([
            'marcaNombre' => 'required|string',
            'modelos.*.nombre' => 'required|string',
            'modelos.*.nombres.*.nombre' => 'required|string',
        ]);
    
        // Guardar Marca
        if ($this->usarSelectMarca) {
            $marca = marcas::where('nombre', $this->marcaNombre)->first();
        } else {
            $marca = marcas::firstOrCreate(['nombre' => $this->marcaNombre]);
        }
    
        // Guardar Modelos y evitar duplicados
        foreach ($this->modelos as $modelo) {
            if ($modelo['usarSelect']) {
                // Buscar modelo existente
                $modeloExistente = modelos::where([
                    ['nombre', '=', $modelo['nombre']],
                    ['marca_id', '=', $marca->id],
                ])->first();
    
                if (!$modeloExistente) {
                    // Crear modelo si no existe
                    $modeloExistente = modelos::create([
                        'nombre' => $modelo['nombre'],
                        'marca_id' => $marca->id,
                    ]);
                }
            } else {
                // Crear un modelo nuevo si no se selecciona uno existente
                $modeloExistente = modelos::firstOrCreate([
                    'nombre' => $modelo['nombre'],
                    'marca_id' => $marca->id,
                ]);
            }
            // Guardar Nombres de Modelos sin duplicados
            foreach ($modelo['nombres'] as $nombre) {
                nombre_modelos::firstOrCreate([
                    'nombre' => $nombre['nombre'],
                    'modelo_id' => $modeloExistente->id,
                ]);
            }
        }
    
        $this->reloadData();
        $this->emit('dataRefreshed', $marca->id, $modeloExistente->id);
    
        // Limpiar el formulario
        $this->modelos = [['nombre' => '', 'usarSelect' => true, 'nombres' => [['nombre' => '']]]];
    
        // Mensaje de éxito
        session()->flash('message', '¡Datos guardados exitosamente!');
    }

    public function render()
    {
        return view('livewire.add-marca-modelos');
    }
}
