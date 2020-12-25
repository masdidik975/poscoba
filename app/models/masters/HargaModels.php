<?php

namespace App\models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HargaModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_harga';
    protected $fillable = ['item_id','harga','input_by','start_date'];
    protected $primaryKey = 'harga_id';


}
