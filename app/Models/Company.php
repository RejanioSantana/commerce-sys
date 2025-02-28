<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "Company";
    protected $fillable = [
            'Name_Company',
            'Name_Fantasy',
            'Cnpj',
            'Phone',
            'IE',
            'ICMS',
    ];

}
