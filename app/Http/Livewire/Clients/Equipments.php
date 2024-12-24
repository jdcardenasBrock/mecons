<?php

namespace App\Http\Livewire\Clients;

use App\Models\Departamento;
use App\Models\equipoCliente;
use App\Models\marcas;
use App\Models\modelos;
use App\Models\nombre_modelos;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Equipments extends Component
{
    public $marca, $nombre_modelo,
        $modelo, $serial, $numero_interno, $ubicacion, $departamentos,
        $clientId, $successMessage, $searchTerm, $dataEquipos, $actionMessage,
        $EditEquipo, $equipmentId;

    public $marcas;
    public $modelos = [];
    public $nombreModelos = [];

    public $marcaSeleccionada = null;
    public $modeloSeleccionado = null;
    public $nombreModeloSeleccionado = null;

    public function render()
    {
        $this->dataEquipos = equipoCliente::with(['marca', 'modelo', 'nombreModelo'])
            ->when($this->searchTerm, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereHas('marca', function ($q) {
                        $q->where('nombre', 'like', '%' . $this->searchTerm . '%');
                    })
                        ->orWhereHas('modelo', function ($q) {
                            $q->where('nombre', 'like', '%' . $this->searchTerm . '%');
                        })
                        ->orWhereHas('nombre_modelo', function ($q) {
                            $q->where('nombre', 'like', '%' . $this->searchTerm . '%');
                        })
                        ->orWhere('serial', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('numero_interno', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('ubicacion', 'like', '%' . $this->searchTerm . '%');
                });
            })
            ->where('id_cliente', '=', $this->clientId)
            ->whereNotNull('id_cliente')
            ->select('id', 'marca', 'modelo', 'nombre_modelo', 'serial', 'numero_interno', 'ubicacion', 'id_cliente')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.clients.equipments');
    }
    protected $rules = [
        'marca' => 'required',
        'nombre_modelo' => 'required'
    ];

    protected $messages = [
        'marca.required' => 'Debe ingresar una marca válida.',
        'nombre_modelo.required' => 'Debe ingresar un nombre del modelo válido.',
    ];
    public function mount($idCliente)
    {
        $this->marcas = marcas::all();
        $this->clientId = $idCliente;
        $this->dataEquipos = equipoCliente::select(
            'marca',
            'nombre_modelo',
            'modelo',
            'serial',
            'numero_interno',
            'ubicacion',
            'id_cliente'
        )->where('id_cliente', '=', $this->clientId)->get();
        $this->departamentos = Departamento::with('municipios')->get();
    }
    public function updatedMarcaSeleccionada($marcaId)
    {
        // Cargar los modelos según la marca seleccionada
        $this->modelos = modelos::where('marca_id', $marcaId)->get();
        $this->modeloSeleccionado = null; // Resetear selección
        $this->nombreModelos = [];
    }
    public function updatedModeloSeleccionado($modeloId)
    {
        // Cargar los nombres de modelo según el modelo seleccionado
        $this->nombreModelos = nombre_modelos::where('modelo_id', $modeloId)->get();
        $this->nombreModeloSeleccionado = null; // Resetear selección
    }

    public function submitEquipos()
    {
        $this->validate([
            'marcaSeleccionada' => 'required',
            'modeloSeleccionado' => 'required',
            'nombreModeloSeleccionado' => 'required',
            'serial' => 'required',
            'numero_interno' => 'required',
            'ubicacion' => 'required',
        ]);

        $equipo = new equipoCliente();
        $equipo->marca = $this->marcaSeleccionada;
        $equipo->nombre_modelo = $this->nombreModeloSeleccionado;
        $equipo->modelo = $this->modeloSeleccionado;
        $equipo->serial = $this->serial;
        $equipo->numero_interno = $this->numero_interno;
        $equipo->ubicacion = $this->ubicacion;
        $equipo->id_cliente = $this->clientId;
        $equipo->save();
        $this->successMessage = "El equipo del cliente ha sido creado satisfactoriamente";
        $this->clearInputs();
    }
    public function updateEquipos()
    {
        $equipo = equipoCliente::findOrFail($this->equipmentId);
        $equipo->marca = $this->marca;
        $equipo->nombre_modelo = $this->nombre_modelo;
        $equipo->modelo = $this->modelo;
        $equipo->serial = $this->serial;
        $equipo->numero_interno = $this->numero_interno;
        $equipo->ubicacion = $this->ubicacion;
        $equipo->save();
        $this->successMessage = "El equipo del cliente ha sido actualizado satisfactoriamente";
        $this->clearInputs();
    }

    public function closeMessage()
    {
        $this->successMessage = '';
        $this->actionMessage = "";
    }
    public function clearInputs()
    {
        $this->marca = null;
        $this->nombre_modelo = null;
        $this->modelo = null;
        $this->serial = null;
        $this->numero_interno = null;
        $this->ubicacion = null;
        $this->resetValues();
    }

    public function encryptId($id)
    {
        $encryptedId = Crypt::encrypt($id);
        return $encryptedId;
    }

    public function decryptId($id)
    {
        $decryptedId = Crypt::decrypt($id);
        return $decryptedId;
    }
    public function edit($id)
    {
        $this->equipmentId = $this->decryptId($id);

        if ($this->equipmentId != null) {
            $this->EditEquipo = equipoCliente::where('id', '=', $this->equipmentId)->first();
            $this->marca = $this->EditEquipo->marca;
            $this->nombre_modelo = $this->EditEquipo->nombre_modelo;
            $this->modelo = $this->EditEquipo->modelo;
            $this->serial = $this->EditEquipo->serial;
            $this->numero_interno = $this->EditEquipo->numero_interno;
            $this->ubicacion = $this->EditEquipo->ubicacion;
        } else {
            $this->actionMessage = "Error con el id del usuario";
        }
    }

    public function drop($id)
    {
        $this->equipmentId = $this->decryptId($id);
        if ($this->equipmentId != null) {
            $equipoEliminar = equipoCliente::where('id', '=', $this->equipmentId);
            $equipoEliminar->delete();
            $this->actionMessage = "Equipo eliminado correctamente";
            $this->clearInputs();
        } else {
            $this->actionMessage = "Error con el id del usuario";
        }
    }
    public function resetValues()
    {
        $this->equipmentId = null;
        $this->EditEquipo = null;
    }
}
