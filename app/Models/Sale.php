<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = "Sale";
    protected $fillable = [
                "Discount_Sale",
                "Date_Sale",
                "Id_User",
                "Id_Client",
    ] ;
}
