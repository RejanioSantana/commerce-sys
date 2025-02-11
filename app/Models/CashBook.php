<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
