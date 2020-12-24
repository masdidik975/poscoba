<?php

namespace App\models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomersModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_customer';
    protected $fillable = ['nama_customer','alamat','telfon','email'];
    protected $primaryKey = 'id_customer';
}
