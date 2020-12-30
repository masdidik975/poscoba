<?php

namespace App\models\roles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleModels extends Model
{
    use SoftDeletes;

    protected $table = 'roles';
    

}
