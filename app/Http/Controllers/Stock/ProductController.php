<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Log;
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
        $category = DB::table("Product_Category")->get();
        return view("stock/addproduct",["title" =>'Adicionar Produto', "unit"=> $unit,"category"=> $category]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
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
                return redirect()->back()->with("flash","Esse produto já existe.");
            };

            $insert = Product::create([
                "Cod_Product"=> $cod,
                "Name_Product"=> strtoupper($validated["name"]),
                "Amount_Product"=> $amount,
                "Min_Amount"=> $minAmount,
                "Purchase_Value"=> $pucharseValue,
                "Sale_Value"=> $saleValue,
                "Note_Product"=> $request["note"],
                "Id_Unit_Type"=> $unit,
                "Id_Product_Category"=> $category,
            ]);
            return redirect()->back()->with("success","Produto adicionado com sucesso.");

      
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



}
