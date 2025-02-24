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
    public static function clientsAll()
    {
        return self::where("id","!=",1)->get();
    }
    public static function cpf()
    {
        //
    }
}
