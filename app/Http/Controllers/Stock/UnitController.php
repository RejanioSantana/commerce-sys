<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        $types = DB::table("Unit_Type")->get();
        return view("stock/unit",["title"=> "Unidade de Produto","data"=> $types]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"=> "required|max:20",
            "shortname"=> "required|max:3",
        ]);
        try {
            DB::table("Unit_Type")->insert([
                "Name_Unit_Type"=> $validated["name"],
                "Short_Name"=> $validated["shortname"],
            ]);
            return redirect()->back();

        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function destroy(string $id)
    {
        DB::table("Unit_Type")->where("id", $id)->delete();
        return redirect()->back();
    }

}
