<?php

namespace App\models\setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TokoModel extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_toko';
    protected $fillable = ['toko_nama','toko_alamat','toko_key','toko_struk_footer','toko_telp'];
    protected $primaryKey = 'id_toko';
}
