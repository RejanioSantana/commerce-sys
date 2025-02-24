<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CashBook extends Model
{
    protected $table = "Cash_Book";
    protected $fillable = [
                "Date_Cash_Book",
                "Note_Cash_Book",
                "Type_Cash_Book",
                "Value_Cash_Book",
                "Id_User",
                "Id_Cash",
                "Id_Client",
 
    ] ;
    public static function insertCashBook($typeInput,$idClient,$value)
    {
        //Verificando se existe caixa e pegando o id.
        $virificationCash = Cash::where("Cash_Date",date('Y-m-01'))->count();

        if($virificationCash > 1){
           return redirect()->back()->with("error","Error interno, avise ao desenvolvedor.");
        }
        if(!$virificationCash){
           $balanceBefore = 0;
           $revenue = 0;
           $expense = 0;

           $previousCash = Cash::where("Cash_Date", "<", date('Y-m-01'))
           ->orderBy("Cash_Date", "desc")
           ->first();

           // Se existir um caixa anterior, pegar o saldo antes
       
           if($previousCash){
               $balanceBefore += $previousCash->Balance_Before;
               
               $book = self::where("Id_Cash",$previousCash->id)->get();

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
            "Cash_Date" => date('Y-m-01')
            ]);
        }
        $cash =   Cash::where("Cash_Date",date('Y-m-01'))->first();
        $cash = $cash->id;

        //Inserindo registro no livro caixa.
        
        self::create([
           "Date_Cash_Book" => date("Y-m-d"),
           "Note_Cash_Book" => "Venda Padrão",
           "Type_Cash_Book" => $typeInput,
           "Value_Cash_Book" => $value,
           "Id_User" => Auth::user()->id,
           "Id_Cash" => $cash,
           "Id_Client" => $idClient
        ]);

    }
}
