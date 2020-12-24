<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\masters\CustomersModels;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        
        $customer = CustomersModels::all();
        return view('pages.masters.customer',compact('customer'));

        // dd($barang);
    }

    public function saveCustomer(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'customer' => ['bail','required'],
            'alamat'=>['required','string'],
            'telfon'=>['required','numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        
        $notif=[];
        try {
            
            $im = new CustomersModels;

            $im->nama_customer      = $req->customer;
            $im->alamat             = $req->alamat;
            $im->telfon             = $req->telfon;
            $im->email              = $req->email;
            $im->save();
            $notif =["success"=>"Data Inserted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function updateCustomer(Request $req)
    {
        
        
        $notif=[];
        try {
            
            $im = CustomersModels::find($req->id);

            $im->nama_customer      = $req->customer;
            $im->alamat             = $req->alamat;
            $im->telfon             = $req->telfon;
            $im->email              = $req->email;
            $im->save();
            
            $notif =["success"=>"Data Updated"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function hapusCustomer($id)
    {
        $notif=[];
        try {
            $im = CustomersModels::where('id_customer',$id);

            $im->delete();
            $notif =["success"=>"Data deleted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }
}
