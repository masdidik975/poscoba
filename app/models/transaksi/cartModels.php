<?php

namespace App\models\transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cartModels extends Model
{
    use SoftDeletes;

    protected $table = 'cart_tab';
    protected $fillable = ['uid','inv_id','item_id','nama','jumlah','harga','subtotal','status'];
    protected $primaryKey = 'cart_id';

    public function itemCart()
    {
        return $this->hasOne('App\models\masters\ItemsModels','id_items','item_id')->with(['item_satuan','item_kategori']);
    }

    public function inventoriCart()
    {
        return $this->hasOne('App\models\transaksi\InventoriModels','id_jenis','inv_id');
    }

    public function userCart()
    {
        return $this->hasOne('App\User','id','uid');
    }

    public function receive_items()
    {
        return $this->hasMany('App\models\transaksi\ReceiveDetailModels','item_id','item_id');
    }

    public function issued_items()
    {
        return $this->hasMany('App\models\transaksi\IssuedDetailModels','item_id','item_id');
    }    

}
