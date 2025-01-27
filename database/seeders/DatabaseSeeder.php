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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table("Company")->insert([
            "Name_Company"=> "Material Andrade",
            "Cnpj_Company" => "64819913000191",
            "Phone_Company"=> 75999531123,
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
    }
}
