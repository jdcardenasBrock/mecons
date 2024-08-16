<?php

namespace App\Http\Livewire\Construction;

use Livewire\Component;
use App\Models\Project;

class ProjectManagement extends Component
{
    public $name, $contract_number, $invoice_number, $start_date, $estimated_end_date, $engineer_in_charge, $architect_in_charge;

    public function saveProject()
    {
        $this->validate([
            'name' => 'required',
            'contract_number' => 'required',
            'invoice_number' => 'required',
            'architect_in_charge' => 'required',
        ]);

        Project::create([
            'name' => $this->name,
            'contract_number' => $this->contract_number,
            'invoice_number' => $this->invoice_number,
            'start_date' => $this->start_date,
            'estimated_end_date' => $this->estimated_end_date,
            'engineer_in_charge' => $this->engineer_in_charge,
            'architect_in_charge' => $this->architect_in_charge,
            'total_value' => 0,
            'total_cost' => 0,
            'profit' => 0,
            'margin' => 0,
        ]);

        session()->flash('message', 'Proyecto creado exitosamente.');
    }

    public function render()
    {
        return view('livewire.construction.project-management');
    }
}
