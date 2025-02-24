<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class Search extends Controller
{
    public function search(Request $request)
    {
        $termo = $request->input('termo');
        $dados = Product::where('Name_Product', 'like', "%{$termo}%")
                        ->orWhere('Cod_Product', 'like', "%{$termo}%")
                        ->get();
        return response()->json([
            'dados' => $dados
        ]);
    
    }
    public function client ()
    {
        return response()->json([
            'data' => Client::all()
        ]);
    }
}
