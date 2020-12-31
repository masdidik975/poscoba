<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\masters\CatagoriesModels;
use App\models\masters\SatuanModels;
use App\models\masters\ItemsModels;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use App\models\transaksi\ReceiveDetailModels;

use App\Jobs\ImportJob;
use Excel;
use App\Excel\EksportKategori;
use App\Excel\EksportSatuan;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($modul)
    {
        $kategori = CatagoriesModels::all();
        $satuan = SatuanModels::all();
        // dd($kategori);

        switch ($modul) {
            case 'show':
                $barang = ItemsModels::with(['item_kategori','item_satuan'])->get();
                break;
            
            default:
                $katid = CatagoriesModels::where('nama_kategori',$modul)->pluck('id_kategori');
                $barang = ItemsModels::where('kategori_items',$katid)->with(['item_kategori','item_satuan'])->get();
                break;
        }
        return view('pages.masters.items',compact('kategori','modul','satuan', 'barang'));

        // dd($barang);
    }

    public function saveItems(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'barang' => 'bail|required|max:50',
            'satuan' => 'required',
            'kategori' => 'required',
        ]);
        
        $notif=[];
        try {
            
            $im = new ItemsModels;

            $im->nama_items     = $req->barang;
            $im->kategori_items = $req->kategori;
            $im->satuan_items   = $req->satuan;
            
            $im->save();

            ItemsModels::where('id_items', $im->id_items)
            ->update(['barcode_code' => $im->id_items.$req->kategori.$req->satuan]);

            $notif =["success"=>"Data Inserted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function updateItems(Request $req)
    {
        
        
        $notif=[];
        try {
            
            $im = ItemsModels::find($req->id);

            $im->nama_items     = $req->barang;
            $im->kategori_items = $req->kategori;
            $im->satuan_items   = $req->satuan;
            $im->barcode_code   = $req->id.$req->kategori.$req->satuan;  

            $im->save();
            $notif =["success"=>"Data Updated"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function hapusItems($id)
    {
        $notif=[];
        try {
            $im = ItemsModels::where('id_items',$id);

            $im->delete();
            $notif =["success"=>"Data deleted"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect()->back()->with($notif);
    }

    public function cariItems(Request $req)
    {
        $item = ItemsModels::whereRaw("upper(nama_items) like '%".strtoupper($req->param)."%'")->with(['item_kategori','item_satuan','receive_items','issued_items'])->get();
        
        

        
        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
        foreach($item as $row)
        {
            $st = $row->receive_items->sum('receive_qty');
            $out = $row->issued_items->sum('issued_qty');
            
            $output .= '
            <li class="dd" data-kode="'.$row->id_items.'" data-harga="'.$row->harga_items.'" data-stok="'.($st - $out).'" data-satuan="'.$row->item_satuan->nama_satuan.'" data-kategori="'.$row->item_kategori->nama_kategori.'"><a class="dropdown-item" href="#">'.$row->nama_items.'</a></li>
            ';
        }
        $output .= '</ul>';
        echo $output;

        
    }

    public function pagePrice($id)
    {
        $cart = ItemsModels::where('id_items',$id)->with(['receive_items','item_kategori','item_satuan'])->first();
        // dd($cart);

        return view('pages.transaksi.harga_baru',compact('cart'));

    }

    public function updatePrice(Request $req)
    {
        $req->validate([
            
            'harga' => 'required|numeric',
        ]);
        
        $notif=[];
        try {
            
            $im = ItemsModels::find($req->kode);
            $im->harga_items   = $req->harga;
            $im->save();
            $notif =["success"=>"Item Harga Berhasil Di perbarui"];
        } catch (\Throwable $th) {
            $notif =["error"=>$th->getMessage()];
        }
        return redirect('/items/show')->with($notif);
        
    }

    public function importPage()
    {

        return view('pages.masters.importexcel');
    }

    public function importFile(Request $req)
    {
        $this->validate($req, [
            'file' => 'required|mimes:xls,xlsx'
        ]);
    
        if ($req->hasFile('file')) {
            
            $file = $req->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'public', $filename
            );
            
            
            ImportJob::dispatch($filename);
            return redirect()->back()->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }

    public function eksportKategori()
    {
        return Excel::download(new EksportKategori, time().'KategoriMaster.xlsx');
    }
    public function eksportSatuan()
    {
        return Excel::download(new EksportSatuan, time().'SatuanMaster.xlsx');
    }
}
