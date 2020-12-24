<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\transaksi\IssuedModels;
use App\models\transaksi\IssuedDetailModels;
use App\models\transaksi\cartModels;
use App\models\masters\CustomersModels;
use Illuminate\Support\Facades\Auth;

use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class IssuedController extends Controller
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
                // $receive = ReceiveModels::whereRaw("date_format(created_at, '%Y-%m') ='".$m."'")->with(['detail_receive','supplier_receive','jenis_receive'])->get();
                $issued = IssuedModels::whereRaw("date_format(created_at, '%Y-%m') ='".$m."'")->with(['detail_issued'])->get();
                // dd($issued);
                break;
            
            default:
                # code...
                break;
        }
        // $supplier = SupplierModels::all();

        // dd($receive);
        return view('pages.transaksi.issued',compact('issued'));

        
    }

    public function buat_sales($modul)
    {
        switch ($modul) {
            case 'baru':
                
                $customer   = CustomersModels::all();   
                $cart       = cartModels::where('inv_id','3')->where('status',"ONCART")->where('uid',Auth::id())->with(['itemCart','userCart','inventoriCart'])->get();
                return view('pages.transaksi.issued_baru', compact('cart','customer'));
                break;
                // dd($cart);
            default:
                # code...
                break;
        }
    }

    public function deleteSales($id)
    {

        $notif=[];
        try {
            $red = IssuedDetailModels::find($id);
            $red->delete();
            $rec = IssuedModels::find($id);
            $rec->delete();
            
            $notif =["success"=>"Data deleted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
        
    }
}
