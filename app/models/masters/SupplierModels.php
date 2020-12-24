<?php

namespace App\models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_supplier';
    protected $fillable = ['nama_supplier','alamat_supplier','telfon_supplier','email_supplier'];
    protected $primaryKey = 'id_supplier';

    
}
