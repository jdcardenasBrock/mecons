<?php

namespace App\Http\Livewire\Crm;

use App\Models\clients;
use App\Models\contactoCliente;
use App\Models\cotizacion;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewTask extends Component
{
    public $clientsData, $clientSelected,
        $infoQoutes, $qouteSelected = null, $idClientSelected,
        $infoContacts, $contactSelected,
        $statusSell, $start_date, $task, $dataTask,
        $expyreDate, $winReason, $notes, $nameClientSelected,
        $taskName, $durationDays;


    public $searchTerm, $showModal;

    //Variables para modal
    public $nameContactClient,
        $phoneContactClient,
        $emailContactClient,
        $positionContactClient;

    public function redirectToSubTask($id)
    {
        if($id){
            return redirect()->route('new_subtask', ['taskId' => $id]);
        }else{
            session()->flash('message', 'Ha ocurrido un error, intente de nuevo mas tarde.');
        }
    }
    public  function mount()
    {
        $this->clientsData = clients::select('id', 'name')->get();
        $this->infoQoutes = collect(); // Inicia la colección vacía
        $this->infoContacts = collect(); // Inicia la colección vacía
    }

    public function updatedclientSelected($value)
    {
        $this->qouteSelected = "";
        $this->idClientSelected = $value;
        $this->infoQoutes = cotizacion::select('id', 'num_cotizacion', 'created_at')
            ->where('client_id', $this->idClientSelected)
            ->OrderBy('created_at', 'desc')->get();
        $this->infoContacts = contactoCliente::select('id', 'name')
            ->where('id_cliente', '=', $this->idClientSelected)
            ->get();
        $this->nameClientSelected = clients::select('name')->where('id', $this->idClientSelected)->first();
    }

    public function render()
    {
        $this->dataTask = Task::select('tasks.id', 'taskName', 'startDate', 'expyreDate', 'durationDays', 'current_status', 'extendedDate', 'notes', 'is_active', 'users.name as asesor', 'created_by', 'id_contact', 'id_cliente', 'id_qoute')
            ->leftJoin('users', 'users.id', 'created_by')
            ->where('id_cliente', $this->idClientSelected)
            ->when($this->searchTerm, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('statusSell', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('notes', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('id_asesor', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('id_contact', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('id_qoute', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('users.name', 'like', '%' . $this->searchTerm . '%'); // Busqueda en nombre del asesor
                });
            })
            ->addSelect([
                'dias_restantes' => DB::raw('DATEDIFF(expyreDate, CURDATE()) as dias_restantes'),
            ])->orderByDesc('is_active') // Primero ordenamos por estado activo (1 es activo)
            ->orderBy(DB::raw('DATEDIFF(expyreDate, CURDATE())'), 'asc')
            ->get();
        return view('livewire.crm.new-task');
    }

    public function saveTask()
    {
        $this->validate([
            'clientSelected' => 'required',
            'statusSell' => 'required',
            'start_date' => 'required',
            'durationDays' => 'required',
        ]);

        if (!is_numeric($this->durationDays)) {
            throw new \Exception("La variable durationDays debe ser un número.");
        }

        $startDate = Carbon::parse($this->start_date);
        $fechaVencimiento = $startDate->addDays($this->durationDays);
        $expyreDate = $fechaVencimiento->format('Y-m-d');
        ($this->qouteSelected == "") ? $this->qouteSelected = null : $this->qouteSelected;

        Task::create([
            'taskName' => $this->taskName,
            'startDate' => $this->start_date,
            'durationDays' => $this->durationDays,
            'expyreDate' => $expyreDate,
            'current_status' => $this->statusSell,
            'notes' => $this->notes,
            'created_by' => Auth::user()->id,
            'id_qoute' => $this->qouteSelected,
            'id_cliente' => $this->clientSelected,
            'id_contact' => $this->contactSelected,
        ]);

        session()->flash('success_message', 'Tarea creada exitosamente.');
        $this->clearForm();
        $this->loadList();
    }
    public function clearForm()
    {
        $this->taskName = "";
        $this->contactSelected = "";
        $this->statusSell = "";
        $this->qouteSelected = "";
        $this->start_date = "";
        $this->durationDays = "";
        $this->notes = "";
    }
    public function saveContact()
    {
        $this->validate([
            'nameContactClient' => 'required',
            'phoneContactClient' => 'required',
            'positionContactClient' => 'required',
        ]);
        contactoCliente::create([
            'name' => $this->nameContactClient,
            'email' => $this->emailContactClient,
            'telephone' => $this->phoneContactClient,
            'position' => $this->positionContactClient,
            'id_cliente' => $this->clientSelected,
        ]);
        $this->infoContacts = contactoCliente::select('id', 'name')
            ->where('id_cliente', '=', $this->idClientSelected)
            ->get();
        $this->clearModal();
    }
    public function loadList(){
        $this->dataTask = Task::select('tasks.id', 'taskName', 'startDate', 'expyreDate', 'durationDays', 'current_status', 'extendedDate', 'notes', 'is_active', 'users.name as asesor', 'created_by', 'id_contact', 'id_cliente', 'id_qoute')
        ->leftJoin('users', 'users.id', 'created_by')
        ->where('id_cliente', $this->idClientSelected)
        ->when($this->searchTerm, function ($query) {
            $query->where(function ($subQuery) {
                $subQuery->where('statusSell', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('notes', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('id_asesor', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('id_contact', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('id_qoute', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('users.name', 'like', '%' . $this->searchTerm . '%'); // Busqueda en nombre del asesor
            });
        })
        ->addSelect([
            'dias_restantes' => DB::raw('DATEDIFF(expyreDate, CURDATE()) as dias_restantes'),
        ])->orderByDesc('is_active') // Primero ordenamos por estado activo (1 es activo)
        ->orderBy(DB::raw('DATEDIFF(expyreDate, CURDATE())'), 'asc')
        ->get();
    }
    public function showModal()
    {
        $this->showModal = true;
    }
    public function clearModal()
    {
        $this->showModal = false;
        $this->nameContactClient = "";
        $this->emailContactClient = "";
        $this->phoneContactClient = "";
        $this->positionContactClient = "";
    }
}
