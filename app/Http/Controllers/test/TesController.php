<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\masters\ItemsModels;

class TesController extends Controller
{
    public function unik()
    {
        $item = ItemsModels::all();
        dd($item);
    }
}
