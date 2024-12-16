<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cost;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function exportProjectCostsPdf($project_id)
    {
        // Obtener los costos del proyecto
        $costs = Cost::where('project_id', $project_id)
            ->orderBy('date', 'asc')
            ->get();

        // Obtener información del proyecto
        $project = Project::findOrFail($project_id);
        $projectName = $project->name;

        // Obtener la fecha actual
        $currentDate = Carbon::now()->format('d/m/Y');

        // Generar el PDF
        $pdf = Pdf::loadView('pdf.project_costs', compact('costs', 'projectName', 'currentDate'));

        // Retornar el PDF para su descarga
        return $pdf->download('Costos_Proyecto_' . $projectName . '.pdf');
    }

}
