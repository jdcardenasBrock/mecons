<?php

namespace App\Http\Livewire\Construction;

use Livewire\Component;
use App\Models\Cost;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectCosts extends Component
{
    public $project_id, $concept, $date, $invoice_number, $contact, $value, $category;
    public $total_value, $total_cost, $profit, $margin, $projectinfo;
    public $costs = [];
    public $searchTerm;

    public $nameEdit, $contract_numberEdit, $invoice_numberEdit, $start_dateEdit, $estimated_end_dateEdit, $engineer_in_chargeEdit, $architect_in_chargeEdit, $total_valueEdit, $total_costEdit, $profitEdit, $marginEdit;



    public function mount($project_id)
    {
        $this->project_id = $project_id;
        $this->loadProjectData();


        $this->projectinfo = Project::select('name', 'contract_number', 'invoice_number', 'start_date', 'estimated_end_date', 'engineer_in_charge', 'architect_in_charge', 'total_value', 'total_cost', 'profit', 'margin')->where('id', $project_id)->first();
        $this->fillFormatEdit();
    }
    protected $messages = [
        'concept.required' => 'Debe ingresar un concepto válido.',
        'date.required' => 'Debe ingresar una fecha válido.',
        'invoice_number.required' => 'Debe ingresar un numero de factura válido.',
        'contact.required' => 'Debe ingresar un contacto válido.',
        'value.required' => 'Debe ingresar un valor válido.',
        'category.required' => 'Debe ingresar una categoria válida.',
    ];

    public function fillFormatEdit()
    {
        $this->nameEdit = $this->projectinfo->name;
        $this->contract_numberEdit = $this->projectinfo->contract_number;
        $this->invoice_numberEdit = $this->projectinfo->invoice_number;
        $this->start_dateEdit = $this->projectinfo->start_date;
        $this->estimated_end_dateEdit = $this->projectinfo->estimated_end_date;
        $this->engineer_in_chargeEdit = $this->projectinfo->engineer_in_charge;
        $this->architect_in_chargeEdit = $this->projectinfo->architect_in_charge;
        $this->total_valueEdit = $this->projectinfo->total_value;
        $this->total_costEdit = $this->projectinfo->total_cost;
        $this->profitEdit = $this->projectinfo->profit;
        $this->marginEdit = $this->projectinfo->margin;
    }
    public function addCost()
    {
        $this->validate([
            'concept' => 'required',
            'date' => 'required|date',
            'invoice_number' => 'required',
            'contact' => 'required',
            'value' => 'required',
            'category' => 'required',
        ]);

        $this->value = str_replace(['$', ' ', '\u{A0}', ','], '', $this->value);

        // Convertir el valor a decimal
        $decimalValue = number_format((float)$this->value, 2, '.', '');
        Cost::create([
            'project_id' => $this->project_id,
            'concept' => $this->concept,
            'date' => $this->date,
            'invoice_number' => $this->invoice_number,
            'contact' => $this->contact,
            'value' => $decimalValue,
            'category' => $this->category,
        ]);

        return redirect()->route('manage_project', $this->project_id)
        ->with('message', 'Costo agregado exitosamente.');
    }

    public function loadProjectData()
    {
        $project = Project::find($this->project_id);
        $this->costs = Cost::where('project_id', $this->project_id)->get()->groupBy('concept');
        $this->total_value = $project->total_value;
        $this->total_cost = $project->costs->sum('value');
        $this->profit = $this->total_value - $this->total_cost;
        $this->margin = $this->total_value > 0 ? ($this->profit / $this->total_value) * 100 : 0;

        $project->update([
            'total_cost' => $this->total_cost,
            'profit' => $this->profit,
            'margin' => $this->margin,
        ]);
    }
    public function updatedTotal_valueEdit($value)
    {
        // Llama a la función que formatea el valor
        $this->total_valueEdit = $this->FormatAmmount($value);
    }

    public function FormatAmmount($numero)
    {
        $numeroSinComa = str_replace(',', '', $numero);
        $numeroFlotante = floatval($numeroSinComa);
        $numeroFormateado = number_format($numeroFlotante, 2, '.', ',');
        return $numeroFormateado;
    }

    public function editProjectData()
    {
        $totalValueEdit = str_replace(',', '', $this->total_valueEdit); // Eliminar comas
        $totalValueEdit = str_replace('.', '.', $totalValueEdit);

        $project = Project::findOrFail($this->project_id);
        $project->name = $this->nameEdit;
        $project->contract_number = $this->contract_numberEdit;
        $project->invoice_number = $this->invoice_numberEdit;
        $project->architect_in_charge = $this->architect_in_chargeEdit;
        $project->engineer_in_charge = $this->engineer_in_chargeEdit;
        $project->start_date = $this->start_dateEdit;
        $project->estimated_end_date = $this->estimated_end_dateEdit;
        $project->total_value = $totalValueEdit;
        $project->save();
        return redirect()->route('manage_project', $this->project_id)
        ->with('message', 'Costo agregado exitosamente.');
    }
    public function render()
    {
        $this->costs = Cost::when($this->searchTerm, function ($query) {
            $query->where(function ($subQuery) {
                $subQuery->where('category', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('concept', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('date', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('invoice_number', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('contact', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('value', 'like', '%' . $this->searchTerm . '%');
            });
        })
            ->where('project_id', '=', $this->project_id)
            ->whereNotNull('project_id')
            ->select('project_id', 'concept', 'date', 'invoice_number', 'contact', 'value', 'category')
            ->orderBy('created_at', 'desc')
            ->get();
          
        return view('livewire.construction.project-costs');
    }
}
