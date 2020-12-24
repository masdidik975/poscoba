<?php

namespace App\models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatagoriesModels extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_kategori';

    protected $fillable = ['nama_kategori'];
    protected $primaryKey = 'id_kategori';
}
