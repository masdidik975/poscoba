<?php

namespace App\models\transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpnameModels extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_opname';
    protected $fillable = ['tanggal_opname','jam_opname','user_opname'];
    protected $primaryKey = 'id_opname';

    public function detail_opname()
    {
        return $this->hasMany('App\models\transaksi\OpnameDetailModels','opname_id','id_opname')->with(['item_opname']);
        
    }

    public function user_opname()
    {
        return $this->hasOne('App\User','id','user_opname');
    }
    
}
