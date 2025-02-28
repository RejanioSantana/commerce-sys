<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "Product";
    protected $fillable = [
                "Cod_Product",
                "Name_Product",
                "Ncm",
                "Amount_Product",
                "Min_Amount",
                "Purchase_Value",
                "Sale_Value",
                "ICMS",
                "Note_Product",
                "Id_Unit_Type",
                "Id_Product_Category",
    ] ;

    public function updateStock($qtd)
    {
        $this->decrement('Amount_Product', $qtd);
    }

}
