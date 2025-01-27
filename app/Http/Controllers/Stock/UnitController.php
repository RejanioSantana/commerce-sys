<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return view("stock/unit",["title"=> "Unidade de Produto"]);
    }
}
