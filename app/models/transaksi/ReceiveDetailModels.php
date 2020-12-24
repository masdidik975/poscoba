<?php

namespace App\models\transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiveDetailModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_item_masuk_detail';
    protected $fillable = ['item_id','receive_harga','receive_qty'];
    protected $primaryKey = 'receive_id';

    public function item_receive()
    {
        return $this->hasOne('App\models\masters\itemsModels','id_items','item_id');
    }

    public function receive_head()
    {
        return $this->belongsTo('App\models\transaksi\ReceiveModels','id_receive','receive_id');
    }

}
