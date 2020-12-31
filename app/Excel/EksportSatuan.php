<?php

namespace App\Excel;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\models\masters\SatuanModels;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EksportSatuan implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id satuan',
            'nama satuan',
            'status',
            'created at',
            'updated at',
            'deleted at'
        ];
    }

    public function collection()
    {
        return SatuanModels::all();
    }
}