<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    protected $table = "Cash";
    protected $fillable = [
                "Balance_Before",
                "Cash_Date",
    ] ;
}
