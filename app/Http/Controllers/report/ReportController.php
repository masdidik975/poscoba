<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\transaksi\OpnameModels;
use App\models\transaksi\OpnameDetailModels;
use App\models\transaksi\ReceiveModels;
use App\models\transaksi\ReceiveDetailModels;
use App\models\transaksi\IssuedModels;
use App\models\transaksi\IssuedDetailModels;
use App\models\masters\ItemsModels;
use Illuminate\Support\Arr;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function stok_indek()
    {
        return view('pages.report.stokexcel');
    }

    public function stok_generate(Request $req)
    {
        $dari   = date('Y-m-d',strtotime($req->dari));
        $sampai = date('Y-m-d',strtotime($req->sampai));

        $item = ItemsModels::where('')with(['item_kategori','item_satuan','receive_items','issued_items'])->get();

        
        dd($item);
    }
}
