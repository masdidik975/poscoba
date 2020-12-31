<?php

namespace App\Excel;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\models\masters\CatagoriesModels;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EksportKategori implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id kategori',
            'nama kategori',
            'status',
            'created at',
            'updated at',
            'deleted at'
        ];
    }

    public function collection()
    {
        return CatagoriesModels::all();
    }
}