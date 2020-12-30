<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\User;
use App\models\roles\RoleModels;


class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $roles = DB::table('roles')->get();
        $user = User::where('id','<>',Auth::user()->id)->with(['userRole'])->get();
        return view('pages.masters.user',compact('user','roles'));
        // dd($user);

    }

    public function aksesUser(Request $req)
    {
        $user = User::where('id',$req->id)->first();
        $user->syncRoles($req->akses);
        
        

        return redirect()->back()->with(["success"=>"Akses Updated"]);
    }

    public function hapusUser($id)
    {
        $notif=[];
        try {
            $user = User::where('id',$id);
            $user->delete();

            DB::table('model_has_roles')->where('model_id', '=', $id)->delete();
            $notif =["success"=>"User berhasil Di Delete"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }

        return redirect()->back()->with($notif);
    }
}
