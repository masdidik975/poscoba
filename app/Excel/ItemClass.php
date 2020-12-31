<?php 

namespace App\Excel;

use App\models\masters\ItemsModels;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Maatwebsite\Excel\Concerns\WithChunkReading;



class ItemClass implements ToModel, WithHeadingRow ,WithChunkReading, ShouldQueue
{

    public function model(array $row)
    {
        
        

        return ItemsModels::firstOrCreate(
            ['barcode_code' => $row['barcode_code']],
            ['nama_items' => $row['item'],
            'kategori_items' => $row['kategori_kode'],
            'satuan_items' => $row['satuan_kode'],
            'harga_items' => $row['harga'],
            'barcode_code' => $row['barcode_code']]
        );
    }
    public function chunkSize(): int
    {
        return 1000; 
    }
} 