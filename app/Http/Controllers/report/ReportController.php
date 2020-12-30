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
use Illuminate\Support\Arr;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function stok_indek()
    {

    }
}
