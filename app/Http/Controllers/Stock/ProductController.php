<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class ProductController extends Controller
{
    public function index()
    {
        return view("stock/index",["title" =>'Adicionar Produto']);
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
            "unit"=> "max:20",
            "category"=> "max:20",
            "note"=> "max:255",
        ]);
            
            $cod = intval($validated["cod"]);
            $amount = intval($validated["amount"]);
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
                "Note_Product"=> $request["unit"],
                "Id_Unit_Type"=> $request["note"],
                "Id_Product_Category"=> $request["category"],
            ]);
            return redirect()->back()->with("success","Produto adicionado com sucesso.");

      
    }

}
