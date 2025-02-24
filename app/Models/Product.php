<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "Product";
    protected $primaryKey = 'Cod_Product'; 
    protected $fillable = [
                "Cod_Product",
                "Name_Product",
                "Amount_Product",
                "Min_Amount",
                "Purchase_Value",
                "Sale_Value",
                "Note_Product",
                "Id_Unit_Type",
                "Id_Product_Category",
    ] ;

    public function updateStock($qtd)
    {
        $this->decrement('Amount_Product', $qtd);
    }

}
