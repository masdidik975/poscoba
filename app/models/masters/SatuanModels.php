<?php

namespace App\models\masters;

use Illuminate\Database\Eloquent\Model;

class SatuanModels extends Model
{
    protected $table = 'tbl_satuan';


    public function satuan_items()
    {
        return $this->belongsTo('App\models\masters\ItemsModels','satuan_items','id_satuan');
    }
}
