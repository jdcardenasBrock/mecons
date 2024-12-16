<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class TaskExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $dataTask;

    public function __construct($dataTask)
    {
        $this->dataTask = $dataTask;
    }

    public function collection()
    {
        return $this->dataTask;
    }

    public function headings(): array
    {
        return [
            '#',
            'Estado de Venta',
            'Fecha de Inicio',
            'Dias de Proceso',
            'Fecha de Vencimiento',
            'Dias Restantes desde Hoy',
            'Asesor',
            'Cliente',
            '# de Cotización',
            'Razon',
            'Notas',
            'Fecha de Creación',
        ];
    }

    public function map($task): array
    {
        $startDateconverted=\Carbon\Carbon::parse($task->startDate)->format('Y-m-d');
        $expiryDateconverted="";
        $crated_at="";
        if($task->startDate){
            $expiryDateconverted=\Carbon\Carbon::parse($task->fecha_vencimiento)->format('Y-m-d');
            $crated_at=\Carbon\Carbon::parse($task->created_at)->format('Y-m-d');
        }
        $labelExpiryDays="";
        if ($task->dias_restantes >= 0){
            $labelExpiryDays=$task->dias_restantes." días";
        }else{
            $labelExpiryDays=abs($task->dias_restantes)." días vencidos";
        }


        return [
            $task->id,
            $task->statusSell,
            $startDateconverted,
            $task->expyreDay,
            $expiryDateconverted,
            $labelExpiryDays,
            ucwords(strtolower($task->asesor)),
            ucwords(strtolower($task->clienteName)),
            ucwords(strtolower($task->qouteName)),
            $task->winReason,
            $task->notes,
            $crated_at,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $date = date('m-d-Y');
        
        // Título
        $sheet->mergeCells('A1:D1');
        $sheet->setCellValue('A1', "Listado de Tareas - Fecha de Exportacion: $date");
        $sheet->getStyle('A1')->getFont()->setSize(18)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->setCellValue('B2', "Cantidad de Registros: ".count($this->dataTask));
        $sheet->getStyle('B2')->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle('B2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C1:H1')->getFont()->setBold(true);



        // Estilos para las cabeceras de la tabla de datos
        $sheet->getStyle('A3:L3')->applyFromArray([
            'font' => [
                'color' => ['argb' => Color::COLOR_WHITE],
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => Color::COLOR_DARKBLUE],
            ],
        ]);

        return [];
    }
    public function startCell(): string
    {
        return 'A3';
    }

    public function title(): string
    {
        return 'Tareas';
    }
}
