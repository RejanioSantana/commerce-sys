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
            "Name_Company"=> "Material Andrade",
            "Name_Fantasy"=> "Material Andrade",
            "Cnpj" => "64819913000191",
            "Phone"=> 75999531123,
            "IE" => 64819913000191,
            "ICMS" => "10.22",
        ]);
        DB::table("users")->insert([
            "First_Name" => "Rejanio",
            "Last_Name" => "Santos",
            "Email" => "jhunior.gt@gmail.com",
            "User_Code" => 123,
            "password" => Hash::make("root"),
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
