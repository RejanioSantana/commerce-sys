<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "Client";
    protected $fillable = [
                "First_Name",
                "Last_Name",
                "Cpf",
                "Email",
                "Whatsapp",
                "Status",
    ] ;
}
