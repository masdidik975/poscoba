<?php

namespace App\Excel;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\models\transaksi\ReceiveView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReceiveExcel implements FromCollection, WithHeadings
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
            'id receive',
            'tanggal',
            'jam',
            'Supplier',
            'jenis',
            'nama items',
            'barcode',
            'receive qty',
            'receive harga'
        ];
    }

    public function collection()
    {
        return ReceiveView::whereBetween('tanggal',[$this->dari,$this->sampai])->get();
    }
}