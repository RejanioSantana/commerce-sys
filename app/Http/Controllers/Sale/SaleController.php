<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\ItemSale;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        return view("sale/index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            "product" => "required",
            "typeSale" => "required"
        ]);
        $data = [
            "product" => $validated['product'],
            "discount" => floatval($request['discount']),
            "nfsCpf" => ($request['nfsCPF'] == 'sim')? 1 : 0,
            "cpf" => ($request['cpf'])? $request['cpf']: "",
            "typeSale" => ($validated['typeSale'] == 2)? 1 : 0,
            "idClient" =>($request['idClient'])? intval($request['idClient']): 1,
            "payClient" => (isNull($request['payClient'])? floatval($request['payClient']): 0)

        ];

        // tipo de venda.
        if($data["typeSale"]){
            dd($data);
        }else{
            dd($data);
            $sale = Sale::create([
                'Discount_Sale' => $data['discount'],
                'Date_Sale' => date('Y-m-d H:i:s'),
                'Id_User' => Auth::user()->id,
                'Id_Client' => 1,
            ]);
            dd('pausa');
            $itensSale = ItemSale::insertItens($data['product'],$sale->id);
            if(!$itensSale){
                return redirect()->back()->with('error','Venda não realizada!');
            }

            
        }

        return redirect()->back()->with('error','Venda não realizada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
