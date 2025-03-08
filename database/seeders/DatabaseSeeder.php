<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        DB::table("Company")->insert([
            "Name_Company"=> "LAFAIETE SILVA DE ANDRADE FILHO",
            "Name_Fantasy"=> "LAFAIETE SILVA DE ANDRADE FILHO",
            "Cnpj" => "40755865000182",
            "Phone"=> 75998015819,
            "IE" => 177814835,
            "ICMS" => "20.5",
            "Nfe" => 0,
        ]);
       
        DB::table("users")->insert([
            "First_Name" => "Lafaete",
            "Last_Name" => "Andrade",
            "Email" => "lafaete@gmail.com",
            "User_Code" => 123456,
            "password" => Hash::make("lafaete"),
            "Status"=> 1,
            "Id_Company" => 1,
         ]);
        DB::table("users")->insert([
            "First_Name" => "Rejanio",
            "Last_Name" => "Santos",
            "Email" => "admin@gmail.com",
            "User_Code" => 123456,
            "password" => Hash::make("junior"),
            "Status"=> 1,
            "Id_Company" => 1,
         ]);
        
        DB::table("Client")->insert([
            "First_Name" => "Padrao",
            "Last_Name" => "System",
            "Cpf" => "1",
            "Email" => "admin@admin.com",
            "Whatsapp" => 1,
            "Status"=> 1,
            "Id_Company" => 1,
         ]);
        
        DB::table("Unit_Type")->insert([
            ["Name_Unit_Type" => "Unidade",
            "Short_Name" => "UN"],
            ["Name_Unit_Type" => "Quilograma",
            "Short_Name" => "KG"],
            ["Name_Unit_Type" => "Litro",
            "Short_Name" => "LT"],
            ["Name_Unit_Type" => "Saco",
            "Short_Name" => "SC"],
            ["Name_Unit_Type" => "Metro Quadrado",
            "Short_Name" => "M2"],
            
         ]);
    }
}
