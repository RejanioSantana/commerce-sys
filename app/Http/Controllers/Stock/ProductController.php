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
                    ->paginate(10);
        }else{
            $data = Product::paginate(10);
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
                "amount"=> "numeric|max:10",
                "min-amount"=> "numeric|max:10",
                "pucharse-value"=> "required|max:11",
                "sale-value"=> "required|max:11",
                "unit"=> "required|max:20",
                "category"=> "required|max:20",
                "note"=> "max:255",
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
        $validated = $request
         ->validate([
             "cod"=> "required|max:20",
             "name"=> "required|max:50",
             "amount"=> "required|max:10",
             "min-amount"=> "required|max:10",
             "pucharse-value"=> "required|max:11",
             "sale-value"=> "required|max:11",
             "unit"=> "required|max:20",
             "category"=> "required|max:20",
             "note"=> "max:255",
         ]);
            
            $cod = intval($validated["cod"]);
            $amount = intval($validated["amount"]);
            $unit = intval($validated["unit"]);
            $category = intval($validated["category"]);
            $minAmount = intval($validated["min-amount"]);
            $pucharseValue = floatval($validated["pucharse-value"]);
            $saleValue = floatval($validated["sale-value"]);

            $statusProduct = Product::where("Cod_Product",$cod)->count();
            if($statusProduct){
                Product::where("Cod_Product",$cod)->update([
                    "Name_Product"=> strtoupper($validated["name"]),
                    "Amount_Product"=> $amount,
                    "Min_Amount"=> $minAmount,
                    "Purchase_Value"=> $pucharseValue,
                    "Sale_Value"=> $saleValue,
                    "Note_Product"=> $request["note"],
                    "Id_Unit_Type"=> $unit,
                    "Id_Product_Category"=> $category,
                ]);
                
                return redirect('/product')->with("success","Produto atualizado com sucesso.");
            };
            dd("Não Atualizou");
            return redirect('/product')->with("error","Error interno, produto NÃO atualizado, informe ao desenvolvedor.");

    }
    public function edit(Request $id)
    {
        $id = $id->input('id');
        $unit = DB::table("Unit_Type")->get();
        $category = DB::table("Product_Category")->get();
        $data = Product::where("Cod_Product", $id)->first();
        
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
