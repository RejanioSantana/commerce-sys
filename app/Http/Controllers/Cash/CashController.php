<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\CashBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cash;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cash = Cash::all();
        return view("cash/index", ["title" => "Caixa", "cash"=> $cash]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("cash/create", ["title" => "Lançamento de Movimento"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //corriging the Datas.
        $validated = $request
        ->validate([
            "type"=> "required|max:2",
            "note"=> "required|max:25",
            "value"=> "required|max:11",
        ]);
        
        $value = str_replace(',','.', $validated['value']);
        $note = strtoupper($validated['note']);
        $type = boolval($validated['type']);

        $response = CashBook::insertCashBook($type,1,$value,$note);
        if($response){
            return redirect()->back()->with("success","Operação realizada com sucesso.");

        }

       return redirect()->back()->with("error","Error na inserção.");

        } catch (\Throwable $th) {
            dd('Error:'. $th->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = intval($id);
        $cashBook = CashBook::where("Id_Cash", $id)->get();
        $balanceBefore = Cash::select("Balance_Before")->where("id", $id)->first();
        $balanceBefore = floatval($balanceBefore['Balance_Before']);
        $revenue = 0;
        $expense = 0;
        $flow = 0;

        foreach ($cashBook as $index) {
            if($index->Type_Cash_Book == 0){
                $expense += $index->Value_Cash_Book;
            }else{
                $revenue += $index->Value_Cash_Book;
            }
            $flow += $index->Value_Cash_Book;
        }
        
        $balance = $revenue - $expense;
        $subtotal = $balanceBefore + $balance;
        
        $report= [$flow,$balanceBefore,$revenue,$expense,$balance,$subtotal];

        return view("cash/show",["title"=> "Livro Caixa",
                                        "data" => $cashBook,
                                        "report" => $report]);
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
