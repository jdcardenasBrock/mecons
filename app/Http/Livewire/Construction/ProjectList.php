<?php

namespace App\Http\Livewire\Construction;

use Livewire\Component;
use App\Models\Project;

class ProjectList extends Component
{
    public $projects;
    public $search = '';
    public $message;

    protected $listeners = ['projectCreated'];

    public function mount()
    {
        $this->loadProjects();
    }
    public function projectCreated($message)
    {
        $this->message = $message;
    }


    public function updatedSearch()
    {
        $this->loadProjects();
    }

    public function loadProjects()
    {
        $this->projects = Project::where('name', 'like', '%' . $this->search . '%')
                                 ->orWhere('contract_number', 'like', '%' . $this->search . '%')
                                 ->orWhere('invoice_number', 'like', '%' . $this->search . '%')
                                 ->orWhere('engineer_in_charge', 'like', '%' . $this->search . '%')
                                 ->orWhere('architect_in_charge', 'like', '%' . $this->search . '%')
                                 ->get();
    }
    public function render()
    {
        return view('livewire.construction.project-list',['projects'=>$this->projects]);
    }
}
