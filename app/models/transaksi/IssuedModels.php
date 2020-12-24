<?php

namespace App\models\transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IssuedModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_item_out';
    protected $fillable = ['tanggal_issued','jam_issued','customer_id','jenis_id'];
    protected $primaryKey = 'id_issued';

    public function detail_issued()
    {
        return $this->hasMany('App\models\transaksi\IssuedDetailModels','issued_id','id_issued')->with(['detail_item']);
    }

    public function customer()
    {
        return $this->hasOne('App\models\masters\CustomersModels','id_customer','customer_id');
    }

    public function jenis_issued()
    {
        return $this->hasOne('App\models\transaksi\InventoriModels','id_jenis','jenis_id');
    }

}
