<?php

namespace App\Excel;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\models\transaksi\Penjualanview;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExcel implements FromCollection, WithHeadings
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
            'id issued',
            'tanggal',
            'jam',
            'customer',
            'jenis',
            'nama items',
            'barcode',
            'issued qty',
            'issued harga',
            'pembayaran'
        ];
    }

    public function collection()
    {
        return Penjualanview::whereBetween('tanggal_issued',[$this->dari,$this->sampai])->get();
    }
}