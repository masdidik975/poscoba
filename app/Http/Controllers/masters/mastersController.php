<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\masters\CatagoriesModels;

class mastersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        
        $kategori = CatagoriesModels::all();
        return view('pages.masters.kategori',compact('kategori'));

        // dd($barang);
    }

    public function saveKategori(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'kategori' => 'bail|required|max:50'
            
        ]);
        
        $notif=[];
        try {
            
            $im = new CatagoriesModels;

            $im->nama_kategori     = $req->kategori;
            $im->save();
            $notif =["success"=>"Data Inserted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function updateKategori(Request $req)
    {
        
        
        $notif=[];
        try {
            
            $im = CatagoriesModels::find($req->id);

            $im->nama_kategori     = $req->kategori;

            $im->save();
            $notif =["success"=>"Data Updated"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function hapusKategori($id)
    {
        $notif=[];
        try {
            $im = CatagoriesModels::where('id_kategori',$id);

            $im->delete();
            $notif =["success"=>"Data deleted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }
}
