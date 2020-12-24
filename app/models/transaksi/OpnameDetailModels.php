<?php

namespace App\models\transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpnameDetailModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_opname_detail';
    protected $fillable = ['opname_id','item_id','opname_qty','opname_modul','opname_harga','key_opname'];
    protected $primaryKey = 'opname_id';

    public function item_opname()
    {
        return $this->hasOne('App\models\masters\itemsModels','id_items','item_id');
    }
}
