<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\transaksi\cartModels;
use Illuminate\Support\Facades\Auth;

use App\models\transaksi\OpnameModels;
use App\models\transaksi\OpnameDetailModels;
use App\models\transaksi\ReceiveModels;
use App\models\transaksi\ReceiveDetailModels;
use App\models\transaksi\IssuedModels;
use App\models\transaksi\IssuedDetailModels;
use Illuminate\Support\Arr;

class OpnameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $m = date('Y-m');
        
        $opname = OpnameModels::whereRaw("date_format(created_at, '%Y-%m') ='".$m."'")->with(['detail_opname','user_opname'])->get();
        return view('pages.transaksi.opname', compact('opname'));

        // dd($opname);
    }

    public function buat_opname($modul)
    {
        switch ($modul) {
            case 'baru':
                
                // $supplier   = SupplierModels::all();   
                $cart       = cartModels::where('inv_id','2')->where('status',"ONCART")->where('uid',Auth::id())->with(['itemCart','userCart','inventoriCart'])->get();
                return view('pages.transaksi.opname_baru', compact('cart'));
                
                break;
                // dd($cart);
            default:
                # code...
                break;
        }
    }

    public function delete_opname($id)
    {

        $hapus = OpnameDetailModels::where('opname_id',$id)->pluck('key_opname','opname_modul');
        $notif=[];
        try {

            if(Arr::exists($hapus, 'OUT') == true){
                $red = IssuedDetailModels::find($hapus['OUT']);
                $red->delete();
                $rec = IssuedModels::find($hapus['OUT']);
                $rec->delete();
            }
    
            if(Arr::exists($hapus, 'IN') == true){
                $red = ReceiveDetailModels::find($hapus['IN']);
                $red->delete();
                $rec = ReceiveModels::find($hapus['IN']);
                $rec->delete();
            }

            $op = OpnameDetailModels::find($id);
            $op->delete();
            $or = OpnameModels::find($id);
            $or->delete();    
            
            $notif =["success"=>"Data deleted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);

        // dd(Arr::exists($hapus, 'IN'));
        
    }

    public function detail_opname($id)
    {
        $opname = OpnameModels::where('id_opname',$id)->with(['detail_opname','user_opname'])->first();

        return view('pages.report.app-opname', compact('opname'));
        // dd($opname);
    }
}
