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
use Livewire\Livewire;

class NewSubtask extends Component
{
    public  $clientSelected, $infoQoutes, $qouteSelected = null, $idClientSelected,
    $infoContacts=null, $contactSelected,
    $statusSell, $start_date, $task, $dataTask,
    $expyreDate, $winReason, $notes, $nameClientSelected,
    $taskName, $durationDays,$taskData;

    public $searchTerm, $showModal;

    //Variables para modal
    public $nameContactClient,
    $phoneContactClient,
    $emailContactClient,
    $positionContactClient;

    public $taskId;

    
    public function mount($taskId)
    {
        $this->taskId = $taskId;
        $this->taskData= Task::where('tasks.id',$taskId)->leftJoin('users','users.id','created_by')->first();
        $this->idClientSelected=$this->taskData->id_cliente;

        $this->infoQoutes = cotizacion::select('id', 'num_cotizacion', 'created_at')
        ->where('client_id', $this->idClientSelected)
        ->OrderBy('created_at', 'desc')->get();
        $this->infoContacts = contactoCliente::select('id', 'name')
            ->where('id_cliente', '=', $this->idClientSelected)
            ->get();
        $this->nameClientSelected = clients::select('name')->where('id', $this->idClientSelected)->first();
    }
    public function backTask()
    {
        Livewire::debug();
        return redirect(route('new_task'));
    }
    public function render()
    {
        return view('livewire.crm.new-subtask');
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
