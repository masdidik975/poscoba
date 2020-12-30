<?php

namespace App\models\roles;

use Illuminate\Database\Eloquent\Model;



class ModelHasRoles_m extends Model
{
    protected $table = 'model_has_roles';

    public function RoleName()
    {
        return $this->hasOne('App\models\roles\RoleModels','id','role_id');
    }
}
