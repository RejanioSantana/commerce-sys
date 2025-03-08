<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\CashBook;
use App\Models\Company;
use App\Models\ItemSale;
use App\Models\Product;
use App\Models\Sale;
use App\Services\NFCE;
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

        try {
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
    
            $sale = Sale::create([
                'Discount_Sale' => $data['discount'],
                'Date_Sale' => date('Y-m-d H:i:s'),
                'Id_User' => Auth::user()->id,
                'Id_Client' => $data['idClient'],
                'Id_Company' => Auth::user()->Id_Company ,
            ]);
            $itensSale = ItemSale::insertItens($data['product'],$sale->id);
            if(!$itensSale){
                return redirect()->back()->with('error','Venda não realizada!');
            }
            $launchCash = CashBook::saleParttern($data['idClient'],$data['product'],$data['discount'],$data['payClient']);    
            if(!$launchCash){
                return redirect()->back()->with('error','Compra não registrada no caixa!');
            }   
    
            foreach($data['product'] as $id => $value){
                $produto = Product::where('id',$id)->first();
                if($produto['Amount_Product']>= $value){
                    $produto->decrement('Amount_Product',$value);
                }
                $produto->decrement('Amount_Product',0);
                
            }
            $company = Company::where('id',Auth::user()->Id_Company)->first();
            $xml = null;
            $xml = NFCE::emitirNFE($company,$data);
            if(!$xml){
                dd('XML não gerado');
            }
            if($company->Nfe){
                
                $xml = NFCE::assinarXML($xml);
                $xml =  NFCE::sendSefaz($xml);
                $this->printNfe($xml);
            }
            
            return redirect()->back()->with('success','Venda realizada!');
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Venda NÃO realizada!');
            
        }

    }
    
    function printNfe($xml)
    {
        $pdf = NFCE::printNfe($xml);
        header('Content-Type: application/pdf');
        echo $pdf;
        
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
