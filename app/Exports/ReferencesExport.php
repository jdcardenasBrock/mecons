<?php

namespace App\Exports;

use App\Models\references;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReferencesExport implements FromQuery, WithHeadings
{

    public function query()
    {
        return references::query()->select('id','name_reference','weights_pounds', 'description', 'brand', 'notes')->limit(10);
    }

    public function headings(): array
    {
        return [
            'id',
            'name_reference',
            'weights_pounds', 'description', 'brand', 'notes'
        ];
    }
}
