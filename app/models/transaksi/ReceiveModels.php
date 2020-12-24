<?php

namespace App\models\transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiveModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_item_masuk';
    protected $fillable = ['tanggal','jam','supplier_id','jenis_id'];
    protected $primaryKey = 'id_receive';

    public function detail_receive()
    {
        return $this->hasMany('App\models\transaksi\ReceiveDetailModels','receive_id','id_receive')->with(['item_receive']);
    }

    public function supplier_receive()
    {
        return $this->hasOne('App\models\masters\SupplierModels','id_supplier','supplier_id');
    }

    public function jenis_receive()
    {
        return $this->hasOne('App\models\transaksi\InventoriModels','id_jenis','jenis_id');
    }
}
