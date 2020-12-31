<?php

namespace App\Excel;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\models\masters\Stokview;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokExcel implements FromCollection, WithHeadings
{
    private $dari;
    private $sampai;
    public function __construct($dari, $sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function headings(): array
    {
        return [
            'id item',
            'nama item',
            'kategori',
            'satuan',
            'barcode',
            'Jumlah In',
            'Jumlah Out',
            'tanggal',
            'sisa'
        ];
    }

    public function collection()
    {
        return Stokview::whereBetween('tgl_masuk',[$this->dari,$this->sampai])->get();
    }
}