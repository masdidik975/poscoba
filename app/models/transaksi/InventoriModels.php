<?php

namespace App\models\transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoriModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_jenis_inventori';
    protected $fillable = ['nama_jenis'];
    protected $primaryKey = 'id_jenis';
}
