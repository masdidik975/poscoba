<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\masters\Stokview;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Excel;
use App\Excel\StokExcel;

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
        $dari = Carbon::createFromFormat('d/m/Y', $req->dari)->format('Y-m-d');
        $sampai = Carbon::createFromFormat('d/m/Y', $req->sampai)->format('Y-m-d');

        

        return Excel::download(new StokExcel($dari, $sampai), date('YmdHis').'stok.xlsx');

         

    }
}
