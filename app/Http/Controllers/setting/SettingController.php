<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\setting\TokoModel;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tokodata()
    {
        return view('pages.setting.toko');
    }

    public function saveToko(Request $req)
    {
        $req->validate([
            'tnama' => 'bail|required',
            'ttelp' => 'required',
            'talamat' => 'required',
            'tkey' => 'required',
            'tfooter' => 'required',
        ]);
        
        $id = TokoModel::first();
        $notif=[];
        try {
            if ($id) {
                $toko = TokoModel::find($id->id_toko);
                $toko->toko_nama = $req->tnama; 
                $toko->toko_telp = $req->ttelp;
                $toko->toko_alamat = $req->talamat;
                $toko->toko_key = $req->tkey;
                $toko->toko_struk_footer=$req->tfooter;
                $toko->save();
            }else{
                $toko = new TokoModel;
                $toko->toko_nama = $req->tnama; 
                $toko->toko_telp = $req->ttelp;
                $toko->toko_alamat = $req->talamat;
                $toko->toko_key = $req->tkey;
                $toko->toko_struk_footer=$req->tfooter;
                $toko->save();
            }
            
            $notif =["success"=>"Update Or Create Successfully"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);

        
            



    }
}
