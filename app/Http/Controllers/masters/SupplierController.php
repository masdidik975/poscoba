<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\masters\SupplierModels;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        
        $supplier = SupplierModels::all();
        return view('pages.masters.supplier',compact('supplier'));

        // dd($barang);
    }

    public function saveSupplier(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'suppliernama' => ['bail','required'],
            'alamat'=>['required','string'],
            'telfon'=>['required','numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        
        $notif=[];
        try {
            
            $im = new SupplierModels;

            $im->nama_supplier     = $req->suppliernama;
            $im->alamat_supplier     = $req->alamat;
            $im->telfon_supplier     = $req->telfon;
            $im->email_supplier     = $req->email;
            $im->save();
            $notif =["success"=>"Data Inserted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function updateSupplier(Request $req)
    {
        
        
        $notif=[];
        try {
            
            $im = SupplierModels::find($req->id);

            $im->nama_supplier     = $req->suppliernama;
            $im->alamat_supplier     = $req->alamat;
            $im->telfon_supplier     = $req->telfon;
            $im->email_supplier     = $req->email;
            $im->save();

            $notif =["success"=>"Data Updated"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function hapusSupplier($id)
    {
        $notif=[];
        try {
            $im = SupplierModels::where('id_supplier',$id);

            $im->delete();
            $notif =["success"=>"Data deleted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }
}
