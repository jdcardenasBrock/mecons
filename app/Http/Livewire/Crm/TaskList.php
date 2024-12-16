<?php

namespace App\Http\Livewire\Crm;

use App\Exports\TaskExport;
use App\Models\clients;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class TaskList extends Component
{
    public $dataTask, $searchTerm, $selectedClient, $qouteNumber, $upcomingDueDays, $clients;
    public $exportLoading = false, $exportLoadingExcel = false;

    public function mount()
    {
        // Cargar todos los clientes al montar el componente
        $this->clients = clients::select('clients.id', 'clients.name')
            ->join('tasks', 'tasks.id_cliente', '=', 'clients.id')
            ->distinct() // Evitar clientes duplicados
            ->get();
    }


    public function exportToExcel()
    {
        set_time_limit(300);

        $this->exportLoadingExcel = true;
        $dataTask = Task::select('tasks.id', 'expyreDay', 'winReason', 'statusSell', 'startDate', 'notes', 'id_asesor', 'id_contact', 'id_qoute', 'tasks.id_cliente', 'users.name as asesor', 'clients.name as clienteName', 'cotizacions.num_cotizacion as qouteName')
            ->leftJoin('users', 'users.id', 'id_asesor')
            ->leftJoin('contacto_clientes', 'contacto_clientes.id', 'id_contact')
            ->leftJoin('cotizacions', 'cotizacions.id', 'id_qoute')
            ->leftJoin('clients', 'clients.id', 'tasks.id_cliente')
            ->addSelect([
                'fecha_vencimiento' => DB::raw('DATE_ADD(startDate, INTERVAL expyreDay DAY) as fecha_vencimiento'),
                'dias_restantes' => DB::raw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) as dias_restantes'),
            ])
            ->when($this->selectedClient, function ($query) {
                return $query->where('tasks.id_cliente', $this->selectedClient);
            })
            ->when($this->qouteNumber, function ($query) {
                return $query->where('cotizacions.num_cotizacion', 'like', '%' . $this->qouteNumber . '%');
            })
            ->when($this->upcomingDueDays, function ($query) {
                return $query->whereRaw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) <= ?', [$this->upcomingDueDays]);
            })
            ->orderBy(DB::raw('
                    CASE
                        WHEN DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) >= 0 THEN 0
                        ELSE 1
                    END
                '), 'asc')
            ->orderBy(DB::raw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE())'), 'asc')
            ->get();
            $filePath = 'excel/TAREAS_' . time() . '.xlsx';
            Excel::store(new TaskExport($dataTask),$filePath,'public');
            $this->emit('excelGenerated', Storage::url($filePath));
            $this->exportLoadingExcel = false;
    }
    public function exportToPDF()
    {
        $this->exportLoading = true;
        $dataTask = Task::select('tasks.id', 'expyreDay', 'winReason', 'statusSell', 'startDate', 'notes', 'id_asesor', 'id_contact', 'id_qoute', 'tasks.id_cliente', 'users.name as asesor', 'clients.name as clienteName', 'cotizacions.num_cotizacion as qouteName')
            ->leftJoin('users', 'users.id', 'id_asesor')
            ->leftJoin('contacto_clientes', 'contacto_clientes.id', 'id_contact')
            ->leftJoin('cotizacions', 'cotizacions.id', 'id_qoute')
            ->leftJoin('clients', 'clients.id', 'tasks.id_cliente')
            ->addSelect([
                'fecha_vencimiento' => DB::raw('DATE_ADD(startDate, INTERVAL expyreDay DAY) as fecha_vencimiento'),
                'dias_restantes' => DB::raw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) as dias_restantes'),
            ])
            ->when($this->selectedClient, function ($query) {
                return $query->where('tasks.id_cliente', $this->selectedClient);
            })
            ->when($this->qouteNumber, function ($query) {
                return $query->where('cotizacions.num_cotizacion', 'like', '%' . $this->qouteNumber . '%');
            })
            ->when($this->upcomingDueDays, function ($query) {
                return $query->whereRaw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) <= ?', [$this->upcomingDueDays]);
            })
            ->orderBy(DB::raw('
        CASE
            WHEN DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) >= 0 THEN 0
            ELSE 1
        END
    '), 'asc')
            ->orderBy(DB::raw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE())'), 'asc')
            ->get();
        $currentDate = Carbon::now()->format('d/m/Y');

        $pdfContent = view('pdf.tasks', compact('dataTask', 'currentDate'))->render();
        $pdf = Pdf::loadHtml($pdfContent)->setPaper('a4', 'landscape')
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        // Guardar el archivo en la carpeta 'public'
        $filePath = 'pdfs/TAREAS_' . time() . '.pdf';
        Storage::disk('public')->put($filePath, $pdf->output());

        // Emitir un evento para notificar a JS
        $this->emit('pdfGenerated', asset('storage/' . $filePath));
    }
    public function render()
    {
        $this->dataTask = Task::select('tasks.id', 'expyreDay', 'winReason', 'statusSell', 'startDate', 'notes', 'id_asesor', 'id_contact', 'id_qoute', 'tasks.id_cliente', 'users.name as asesor', 'clients.name as clienteName', 'cotizacions.num_cotizacion as qouteName')
            ->leftJoin('users', 'users.id', 'id_asesor')
            ->leftJoin('contacto_clientes', 'contacto_clientes.id', 'id_contact')
            ->leftJoin('cotizacions', 'cotizacions.id', 'id_qoute')
            ->leftJoin('clients', 'clients.id', 'tasks.id_cliente')
            ->addSelect([
                'fecha_vencimiento' => DB::raw('DATE_ADD(startDate, INTERVAL expyreDay DAY) as fecha_vencimiento'),
                'dias_restantes' => DB::raw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) as dias_restantes'),
            ])
            ->when($this->selectedClient, function ($query) {
                return $query->where('tasks.id_cliente', $this->selectedClient);
            })
            ->when($this->qouteNumber, function ($query) {
                return $query->where('cotizacions.num_cotizacion', 'like', '%' . $this->qouteNumber . '%');
            })
            ->when($this->upcomingDueDays, function ($query) {
                return $query->whereRaw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) <= ?', [$this->upcomingDueDays]);
            })
            ->orderBy(DB::raw('
            CASE
                WHEN DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE()) >= 0 THEN 0
                ELSE 1
            END
        '), 'asc')
            ->orderBy(DB::raw('DATEDIFF(DATE_ADD(startDate, INTERVAL expyreDay DAY), CURDATE())'), 'asc')
            ->get();
        return view('livewire.crm.task-list');
    }
}
