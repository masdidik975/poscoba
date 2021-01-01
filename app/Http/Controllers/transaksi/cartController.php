<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\transaksi\cartModels;
use App\models\transaksi\ReceiveModels;
use App\models\transaksi\ReceiveDetailModels;
use App\models\masters\ItemsModels;
use Illuminate\Support\Facades\Auth;

use App\models\transaksi\IssuedModels;
use App\models\transaksi\IssuedDetailModels;

use App\models\transaksi\OpnameModels;
use App\models\transaksi\OpnameDetailModels;
use Carbon\Carbon;

use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class cartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function saveCart(Request $req, $modul)
    {
        
        
        $notif=[];
        switch ($modul) {
            case 'pembelian':
                
                $insert = ["uid"=>Auth::id(),"inv_id"=>1, "item_id"=>$req->kode,"nama"=>$req->item,"jumlah"=>$req->jumlah,"harga"=>$req->harga ,"subtotal"=>$req->harga  * $req->jumlah ,"status"=>"ONCART"];
                cartModels::updateOrCreate($insert,$insert);
                $notif =["success"=>"Item berhasil di tambahkan"];

                return redirect()->back()->with($notif);
                break;
            case 'receive-save':
                $im = cartModels::where('uid',Auth::id())->where('inv_id',1)->where('status','ONCART')->get();

                
                $notif=[];
                    try {
                        $rec = new ReceiveModels;

                        $rec->tanggal = date('Y-m-d');
                        $rec->supplier_id = $req->param;
                        $rec->jenis_id = 1;
                        $rec->save();
                        // $rec->id_receive;

                        $insert=[];
                        foreach ($im as $k => $v) {
                            $insert[]=[
                                        'receive_id'=>$rec->id_receive,
                                        'item_id'=>$v->item_id,
                                        'receive_harga'=>$v->harga,
                                        'receive_qty'=>$v->jumlah,
                                        'created_at'=>Carbon::now('Asia/Jakarta')
                            ];
                        }

                        $de = ReceiveDetailModels::insert($insert);
                        cartModels::where('uid',Auth::id())->where('inv_id',1)->where('status','ONCART')->update(['status'=>'CLOSED']);
                        $notif =["success"=>"Data Tersimpan"];
                    } catch (\Throwable $th) {
                        $notif =["error"=>$th->getMessage()];
                    }

                    // dd($notif);
                    // return redirect()->back()->with($notif);
                    
                break;
            case 'kasir':
                
                $item = ItemsModels::whereRaw("barcode_code = '".$req->barcode."'")->with(['item_kategori','item_satuan','receive_items','issued_items'])->first();

                if($item != null)
                {   
                    $in     = $item->receive_items->sum('receive_qty');
                    $out    = $item->issued_items->sum('issued_qty');

                    if($in - $out >= 0 ){
                        $cart = cartModels::where('uid',Auth::id())->where('inv_id','3')->where('item_id',$item->id_items)->where('status','ONCART')->first();
                        $update = [
                            "item_id"=>$item->id_items,"nama"=>$item->nama_items,"jumlah"=>( $cart!= null ? $cart->jumlah : 0) + 1 ,"harga"=>$item->harga_items, "subtotal"=>(($cart != null ? $cart->jumlah : 0 ) + 1 ) * $item->harga_items
                            ];
                        $where = [
                            "uid"=>Auth::id(),"inv_id"=>3, "item_id"=>$item->id_items, "status"=>"ONCART"
                            ];    
                        cartModels::updateOrCreate($where,$update);
                        $notif =["success"=>"Item berhasil di tambahkan"];
                    }else{
                        $notif =["error"=>$item->nama_items. "Sisa Stok Telah Habis"];    
                    }
                    
                }else{
                    $notif =["error"=>"Item Tidak di temukan"];
                }
                
                // dd($item == null);
                return redirect()->back()->with($notif);
                break;    

            case 'kasir-save':
                $im = cartModels::where('uid',Auth::id())->where('inv_id',3)->where('status','ONCART')->get();
                // dd($im);
                
                $notif=[];
                    try {
                        $rec = new IssuedModels;

                        $rec->tanggal_issued = date('Y-m-d');
                        $rec->customer_id = $req->param;
                        $rec->pembayaran = $req->pay;
                        $rec->jenis_id = 3;
                        $rec->save();
                        // $rec->id_receive;

                        $insert=[];
                        foreach ($im as $k => $v) {
                            $insert[]=[
                                        'issued_id'=>$rec->id_issued,
                                        'item_id'=>$v->item_id,
                                        'issued_harga'=>$v->harga,
                                        'issued_qty'=>$v->jumlah,
                                        'created_at'=>Carbon::now('Asia/Jakarta')
                            ];
                        }

                        $de = IssuedDetailModels::insert($insert);
                        cartModels::where('uid',Auth::id())->where('inv_id',3)->where('status','ONCART')->update(['status'=>'CLOSED']);
                        $notif =["success"=>"Data Tersimpan"];
                    } catch (\Throwable $th) {
                        $notif =["error"=>$th->getMessage()];
                    }

                    return $notif;
                    // return redirect('sales/show')->with($notif);

                break;
            case 'opname':
            
                $insert = ["uid"=>Auth::id(),"inv_id"=>2, "item_id"=>$req->kode,"nama"=>$req->item,"jumlah"=>$req->jumlah,"harga"=>$req->harga ,"subtotal"=>$req->harga  * $req->jumlah ,"status"=>"ONCART"];
                cartModels::updateOrCreate($insert,$insert);
                $notif =["success"=>"Item berhasil di tambahkan"];

                return redirect()->back()->with($notif);
                break;
            case 'opname-save':
                $im = cartModels::where('uid',Auth::id())->where('inv_id',2)->where('status','ONCART')->with(['receive_items','issued_items'])->get();
                
                //tblopname
                

                // dd([$kombinasi]);
                
                $notif=[];
                try {
                    $opname = new OpnameModels;
                    $opname->tanggal_opname= date('Y-m-d');
                    $opname->jam_opname= Carbon::now('Asia/Jakarta');
                    $opname->user_opname = Auth::user()->id;
                    $opname->save();
                    
                    $in_issued=[];
                    $in_receive=[];
                    $op=[];
                    $or=[];
                    $stok =[];
                    foreach ($im as $row) {
                        $st = $row->receive_items->sum('receive_qty');
                        $out = $row->issued_items->sum('issued_qty');
                        $dps = $st - $out;

                        if(($dps - $row->jumlah) > 0 ){
                            $in_issued[] = [
                                'issued_id'=>"",
                                'item_id'=>$row->item_id,
                                'issued_harga'=>$row->harga,
                                'issued_qty'=>$dps - $row->jumlah,
                                'created_at'=>Carbon::now('Asia/Jakarta')
                            ];
                            $op[] = [
                                'opname_id'=>$opname->id_opname,
                                'item_id'=>$row->item_id,
                                'opname_qty'=>$dps - $row->jumlah,
                                'opname_harga'=>$row->harga,
                                'opname_modul'=>"OUT",
                                'key_opname'=>"",
                                'created_at'=>Carbon::now('Asia/Jakarta')
                            ];
                        }else{
                            $in_receive[] =[
                                'receive_id'=>"",
                                'item_id'=>$row->item_id,
                                'receive_harga'=>$row->harga,
                                'receive_qty'=>$row->jumlah - $dps,
                                'created_at'=>Carbon::now('Asia/Jakarta')
                            ];
                            $or[] = [
                                'opname_id'=>$opname->id_opname,
                                'item_id'=>$row->item_id,
                                'opname_qty'=>$row->jumlah - $dps,
                                'opname_harga'=>$row->harga,
                                'opname_modul'=>"IN",
                                'key_opname'=>"",
                                'created_at'=>Carbon::now('Asia/Jakarta')
                            ];
                        }

                    
                    }
                    
                    

                    if($in_issued)
                    {
                        $reci = new IssuedModels;

                        $reci->tanggal_issued = date('Y-m-d');
                        $reci->jenis_id = 2;
                        $reci->save();
                        foreach ($in_issued as $k => $v) {
                            $in_issued[$k]["issued_id"] = $reci->id_issued;
                            $op[$k]["key_opname"]=$reci->id_issued;
                        }
                        $de = IssuedDetailModels::insert($in_issued);
                    }
                    if($in_receive)
                    {
                        $rec = new ReceiveModels;
                        $rec->tanggal = date('Y-m-d');
                        $rec->jenis_id = 2;
                        $rec->save();

                        foreach ($in_receive as $k => $v) {
                            $in_receive[$k]["receive_id"] = $rec->id_receive;
                            $or[$k]["key_opname"]=$rec->id_receive;
                        }

                        $de = ReceiveDetailModels::insert($in_receive);
                    }

                    $kombinasi = array_merge($op, $or);   
                    cartModels::where('uid',Auth::id())->where('inv_id',2)->where('status','ONCART')->update(['status'=>'CLOSED']);
                    OpnameDetailModels::insert($kombinasi);
                    
                    
                    $notif =["success"=>"Data Berhasil Di Sesuaikan"];
                } catch (\Throwable $th) {
                    $notif =["error"=>$th->getMessage()];

                    // return $th;
                }


                return redirect('/opname')->with($notif);
                    
                break;      
            default:
                # code...
                break;
        }

        
        
    }

    public function clearCart($modul)
    {
        
        
        
        switch ($modul) {
            case 'pembelian':
                $notif=[];
                    try {
                        $im = cartModels::where('uid',Auth::id())->where('inv_id',1)->where('status','ONCART');

                        $im->delete();
                        $notif =["success"=>"Data deleted"];
                    } catch (\Throwable $th) {
                        $notif =["error"=>$th->getMessage()];
                    }
                    return redirect()->back()->with($notif);
                break;
            case 'kasir':
                $notif=[];
                    try {
                        $im = cartModels::where('uid',Auth::id())->where('inv_id',3)->where('status','ONCART');

                        $im->delete();
                        $notif =["success"=>"Data deleted"];
                    } catch (\Throwable $th) {
                        $notif =["error"=>$th->getMessage()];
                    }
                    return redirect()->back()->with($notif);
                break;    
            case 'opname':
                $notif=[];
                    try {
                        $im = cartModels::where('uid',Auth::id())->where('inv_id',2)->where('status','ONCART');

                        $im->delete();
                        $notif =["success"=>"Data deleted"];
                    } catch (\Throwable $th) {
                        $notif =["error"=>$th->getMessage()];
                    }
                    return redirect()->back()->with($notif);
                break;    
            default:
                # code...
                break;
        }

        
    }

    public function deleteCart($id)
    {
        $notif=[];
        try {
            $im = cartModels::where('cart_id',$id);

            $im->delete();
            $notif =["success"=>"Data deleted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function updateCart(Request $req, $modul)
    {
        $notif=[];
        switch ($modul) {

            case 'kasir':
                // dd($req->all());
                
                
                try {
                    $ic     = cartModels::where('uid',Auth::id())->where('inv_id','3')->where('item_id',$req->kodecart)->where('status','ONCART')->first();
                    $cart   = cartModels::where('uid',Auth::id())->where('inv_id','3')->where('item_id',$req->kodecart)->where('status','ONCART')->update(['jumlah'=>$req->jmlcart,'subtotal'=>($req->jmlcart * $ic->harga)]);                    
                    $notif =["success"=>"Data Updated"];
                } catch (\Throwable $th) {
                    $notif =["error"=>$th->getMessage()];
                }
                
                break;
            
            default:
                # code...
                break;
        }

        return redirect()->back()->with($notif);
    }
}
