<?php

namespace App\models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemsModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_item';
    protected $fillable = ['nama_items','kategori_items','satuan_items','harga_items','barcode_code'];
    protected $primaryKey = 'id_items';

    public function item_kategori()
    {
        return $this->hasOne('App\models\masters\CatagoriesModels','id_kategori','kategori_items');
    }

    public function item_satuan()
    {
        return $this->hasOne('App\models\masters\SatuanModels','id_satuan','satuan_items');
    }

    public function receive_items()
    {
        return $this->hasMany('App\models\transaksi\ReceiveDetailModels','item_id','id_items');
    }

    public function issued_items()
    {
        return $this->hasMany('App\models\transaksi\IssuedDetailModels','item_id','id_items');
    }

    public function harga_items()
    {
        return $this->hasMany('App\models\masters\HargaModels','item_id','id_items');
    }

    


}
