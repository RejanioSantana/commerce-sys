<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    protected $table = "Sale";

    protected $fillable = ['Cod_Product',
                        'Name_Item_Sale',
                        'Amount_Item',
                        'Unit_Value',
                        'Id_Sale'];

    public static function insertItens(array $itens,$idSale)
    {
        $dataInsert = [];
        foreach ($itens as $cod => $qtd) {
            $item = Product::where('Cod_Product',$cod)->get()->first();
            if(!$item){
                return false;
            }
             $dataInsert[] = [
                 'Cod_Product'   => $cod,
                 'Name_Item_Sale' => $item['Name_Product'],
                 'Amount_Item' => $qtd,
                 'Unit_Value'      => $item['Sale_Value'],
                 'Id_Sale'      => $idSale,
                 'created_at' => now(),
                 'updated_at' => now(),
             ];
        }
        return self::insert($dataInsert);
    }

}
