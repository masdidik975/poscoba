<?php

namespace App\models\transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IssuedDetailModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_item_out_detail';
    protected $fillable = ['item_id','issued_qty','issued_harga'];
    protected $primaryKey = 'issued_id';

    public function detail_item()
    {
        return $this->hasOne('App\models\masters\ItemsModels','id_items','item_id')->with(['item_satuan','item_kategori']);
    }
}
