<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        
        if ($request->input('s')) {

            $data = Product::where('Name_Product',"like","%{$request->input('s')}%")
                    ->where('Id_Company',Auth::user()->Id_Company)
                    ->paginate(10);
        }else{
            $data = Product::where('Id_Company',Auth::user()->Id_Company)
                    ->paginate(10);
        }

        return view("stock/index",["title" =>'Lista de Produto','data'=> $data]);
    }
    public function create()
    {
        
        $unit = DB::table("Unit_Type")->get();
        $category = DB::table("Product_Category")->where('Id_Company',Auth::user()->Id_Company)->get();
        return view("stock/addproduct",["title" =>'Adicionar Produto', "unit"=> $unit,"category"=> $category]);
    }
    public function store(Request $request)
    {
        try {
            $cod = null;
            $amount = null;
            $min = null;

            $validated = $request->validate([
                "cod"=> "",
                "ncm"=> "required|numeric",
                "name"=> "required",
                "amount"=> "numeric",
                "min-amount"=> "numeric",
                "pucharse-value"=> "required",
                "sale-value"=> "required",
                "unit"=> "required",
                "category"=> "required",
                "note"=> "",
            ]);
            

            switch(strlen(trim($validated["cod"]))){
                case 0: 
                    $cod = "SEM GTIN";
                    break;
                case 8:
                    $cod = intval($validated["cod"]);
                    break;
                case 12:
                    $cod = intval($validated["cod"]);
                    break;
                case 13:
                    $cod = intval($validated["cod"]);
                    break;
                case 14:
                    $cod = intval($validated["cod"]);
                    break;
                default:
                    return redirect()->back()->with('error', "Codigo de Barra invalido. \n Apenas com 8,12,13 e 14 digitos.");
            }
            switch(strlen($validated["amount"])){
                case 0: 
                    $amount = 0;
                default:
                    $amount = intval($validated["amount"]);
                    
            }
            switch(strlen($validated["min-amount"])){
                case 0: 
                    $min = 0;
                default:
                    $min = intval($validated["min-amount"]);
                    
            }
            $data = [ 
                "cod" => $cod,
                "name" => strtoupper($validated["name"]),
                "ncm" => intval($validated["ncm"]),
                "amount" => $amount,
                "minAmount" => $min,
                "unit" => intval($validated["unit"]),
                "category" => intval($validated["category"]),
                "pucharseValue" => floatval($validated["pucharse-value"]),
                "saleValue" => floatval($validated["sale-value"]),
                "note" => $request['note'],
                
            ];
            $statusProduct = Product::where("Cod_Product",$data['cod'])->where('Id_Company',Auth::user()->Id_Company )->count();
            
            if($statusProduct){
                return redirect()->back()->with("flash","Esse produto já existe.");
            };
            $insert = Product::create([
                
                "Cod_Product"=> $data['cod'],
                "Name_Product"=> $data['name'],
                "Ncm"=> $data['ncm'],
                "Amount_Product"=> $data['amount'],
                "Min_Amount"=> $data['minAmount'],
                "Purchase_Value"=> $data['pucharseValue'],
                "Sale_Value"=> $data['saleValue'],
                "Note_Product"=> $data['note'],
                "Id_Unit_Type"=> $data['unit'],
                "Id_Product_Category"=> $data['category'],
                "Id_Company"=> Auth::user()->Id_Company,
            ]);
            if($insert){
                return redirect()->back()->with("success","Produto adicionado com sucesso.");
                
            }
            
            return redirect()->back()->with("error","Error na inserção.");
                
            } catch (\Throwable $th) {
                dd('Error', $th->getMessage());
                return redirect()->back()->with("error","Item não cadastrado, verifique se os dados estão corretos.");
            
        }
        
      
    }
    public function update(Request $request)
    {  
        try {
            
        $cod = null;
        $amount = null;
        $min = null;

        $validated = $request->validate([
            "idP" => "",
            "ncm"=> "required|numeric",
            "name"=> "required",
            "amount"=> "numeric",
            "min-amount"=> "numeric",
            "pucharse-value"=> "required",
            "sale-value"=> "required",
            "unit"=> "required",
            "category"=> "required",
            "note"=> "",
        ]);
        

        
        switch(strlen($validated["amount"])){
            case 0: 
                $amount = 0;
            default:
                $amount = intval($validated["amount"]);
                
        }
        switch(strlen($validated["min-amount"])){
            case 0: 
                $min = 0;
            default:
                $min = intval($validated["min-amount"]);
                
        }
        $data = [ 
            "id" => intval($validated["idP"]),
            "cod" => $cod,
            "name" => strtoupper($validated["name"]),
            "ncm" => intval($validated["ncm"]),
            "amount" => $amount,
            "minAmount" => $min,
            "unit" => intval($validated["unit"]),
            "category" => intval($validated["category"]),
            "pucharseValue" => floatval($validated["pucharse-value"]),
            "saleValue" => floatval($validated["sale-value"]),
            "note" => $request['note'],
            
        ];

        $statusProduct = Product::where("id",$data['id'])
        ->where('Id_Company',Auth::user()->Id_Company)->count();
        if($statusProduct){
            Product::where("id",$data['id'])->update([
                "Name_Product"=> $data['name'],
                "Ncm"=> $data['ncm'],
                "Amount_Product"=> $data['amount'],
                "Min_Amount"=> $data['minAmount'],
                "Purchase_Value"=> $data['pucharseValue'],
                "Sale_Value"=> $data['saleValue'],
                "Note_Product"=> $data['note'],
                "Id_Unit_Type"=> $data['unit'],
                "Id_Product_Category"=> $data['category'],
            ]);
            
            return redirect('/product')->with("success","Produto atualizado com sucesso.");
        };
        return redirect('/product')->with("error","Error interno, produto NÃO atualizado, informe ao desenvolvedor.");

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function edit(Request $id)
    {
        $id = $id->input('id');
        $unit = DB::table("Unit_Type")->get();
        $category = DB::table("Product_Category")
                    ->where('Id_Company',Auth::user()->Id_Company)->get();
        $data = Product::where("id", $id)
                ->where('Id_Company',Auth::user()->Id_Company)->first();
        
        return view("stock/productupdate",["title" =>'Atualizar Produto', "data" => $data,"category"=> $category,"unit"=> $unit]);

    }

    public function sCode(Request $id)
    {
        $id = $id->input('termo');

        $url = "https://api.cosmos.bluesoft.com.br/gtins/$id.json";
        $agent = 'Cosmos-API-Request';
        $headers = array(
            "Content-Type: application/json",
            "X-Cosmos-Token: cQeCBAKbgXpbn1zVnr-aCA"
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERAGENT, $agent);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        $data = curl_exec($curl);
        if ($data === false || $data == NULL) {
            var_dump(curl_error($curl));
            return response()->json([
                'dados' => null
            ]);
        } else {
            // $object = json_decode($data);
            return response()->json([
                 'dados' => json_decode($data, true) 
             ]);
        }
        
    }

}
