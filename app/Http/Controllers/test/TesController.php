<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\masters\ItemsModels;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\User;

class TesController extends Controller
{
    public function unik()
    {
        $item = ItemsModels::all();
        dd($item);
    }

    public function CreateUserRole()
    {
        if(Auth::user()){
            // check group is empty
          $roles = DB::table('roles')->count();
          if($roles == null){
            //if group empty add two group and assign permission
            $purchase   = Role::create(['name' => 'Purchase']);
            // $permissionEditor = Permission::create(['name' => 'create']);
            // $editor->givePermissionTo($permissionEditor);
            $user       = Role::create(['name' => 'User']);
            $admin      = Role::create(['name' => 'Admin']);
            $kasir      = Role::create(['name' => 'Kasir']);
            $manager    = Role::create(['name' => 'Manager']);
            // $permission = Permission::create(['name' => 'approve articles']);
            // $admin->givePermissionTo($permission,$permissionEditor);
          } 
          //if 
        //     $user = Auth::user();
        //     if($role === 'admin'){
        //       $user->removeRole('Editor');
        //       $user->assignRole('Admin');
        //     }
        //     else{
        //       $user->removeRole('Admin');
        //       $user->assignRole('Editor'); 
        //    }
        }
        return redirect()->back();
    }

    public function didik()
    {
        $id=1;
        $didik = User::find($id)->first();
        $didik->assignRole('Admin'); 
    }
}
