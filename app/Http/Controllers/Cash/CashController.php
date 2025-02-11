<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\CashBook;
use Auth;
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
        //corriging the Datas.
        $validated = $request
         ->validate([
             "type"=> "required|max:1",
             "note"=> "required|max:25",
             "month"=> "required|max:2",
             "year"=> "required|max:4",
             "value"=> "required|max:11",
         ]);
         
         $value = str_replace(',','.', $validated['value']);
         $note = strtoupper($validated['note']);
         $type = boolval($validated['type']);

         //Date of Cash
         $dateCash = "$request->year-$request->month-1"; 
         $dateCash = date("Y-m-d", strtotime($dateCash));

         //Verificando se existe caixa e pegando o id.
         $virificationCash = Cash::where("Cash_Date",$dateCash)->count();

         if($virificationCash > 1){
            return redirect()->back()->with("error","Error interno, avise ao desenvolvedor.");
         }
         if(!$virificationCash){
            $balanceBefore = 0;
            $revenue = 0;
            $expense = 0;

            $previousCash = Cash::where("Cash_Date", "<", $dateCash)
            ->orderBy("Cash_Date", "desc")
            ->first();

            // Se existir um caixa anterior, pegar o saldo antes
        
            if($previousCash){
                $balanceBefore += $previousCash->Balance_Before;
                
                $book = CashBook::where("Id_Cash",$previousCash->id)->get();

                foreach($book as $index){
                    if($index->Type_Cash_Book){
                        $revenue += $index->Value_Cash_Book;
                        continue;
                    }
                    $expense += $index->Value_Cash_Book;
                    
                }

            }
            
            $balanceBefore = $balanceBefore + ($revenue - $expense);
            
            // Criando novo caixa com o saldo anterior
             Cash::create([
             "Balance_Before" => $balanceBefore,
             "Cash_Date" => $dateCash
             ]);
         }
         $cash =   Cash::where("Cash_Date",$dateCash)->first();
         $cash = $cash->id;

         //Inserindo registro no livro caixa.
         
         CashBook::create([
            "Date_Cash_Book" => date("Y-m-d"),
            "Note_Cash_Book" => $note,
            "Type_Cash_Book" => $type,
            "Value_Cash_Book" => $value,
            "Id_User" => Auth::user()->id,
            "Id_Cash" => $cash,
            "Id_Client" => 1
         ]);

        return redirect()->back()->with("success","Operação realizada com sucesso.");
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
