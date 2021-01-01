<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\transaksi\ReceiveModels;
use App\models\transaksi\ReceiveDetailModels;
use App\models\transaksi\cartModels;
use App\models\masters\ItemsModels;
use App\models\masters\SupplierModels;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
class ReceiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req, $modul)
    {
        
        switch ($modul) {
            case 'show':
                $m = date('Y-m');
                $receive = ReceiveModels::whereRaw("date_format(created_at, '%Y-%m') ='".$m."'")->with(['detail_receive','supplier_receive','jenis_receive'])->get();

                
                break;
            
            default:
                $dari = Carbon::createFromFormat('d/m/Y', $req->dari)->format('Y-m-d');
                $sampai = Carbon::createFromFormat('d/m/Y', $req->sampai)->format('Y-m-d');
                $receive = ReceiveModels::whereBetween('tanggal',[$dari,$sampai])->with(['detail_receive','supplier_receive','jenis_receive'])->get();
                break;
        }
        // $supplier = SupplierModels::all();

        // dd($receive);
        return view('pages.transaksi.receive',compact('receive'));

        
    }

    public function buat_pembelian($modul)
    {
        switch ($modul) {
            case 'baru':
                
                $supplier   = SupplierModels::all();   
                $cart       = cartModels::where('inv_id','1')->where('status',"ONCART")->where('uid',Auth::id())->with(['itemCart','userCart','inventoriCart'])->get();
                return view('pages.transaksi.receive_baru', compact('cart','supplier'));
                break;
                // dd($cart);
            default:
                # code...
                break;
        }
    }

    public function deleteReceive($id)
    {

        $notif=[];
        try {
            $red = ReceiveDetailModels::find($id);
            $red->delete();
            $rec = ReceiveModels::find($id);
            $rec->delete();
            
            $notif =["success"=>"Data deleted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
        
    }

    public function detailReceive($id)
    {
        $rec        = ReceiveModels::where('id_receive',$id)->with(['supplier_receive'])->first();
        $recDetail  = ReceiveDetailModels::where('receive_id',$id)->with(['item_receive'])->get();
        // dd([$recDetail, $rec]);

        return view('pages.report.app-receive',compact('recDetail','rec') );
    }
}
