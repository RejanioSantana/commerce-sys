<?php

namespace App\Http\Controllers\Client;

use App\Classes\Whatsapp;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view("client/index", ["title" => "Cliente","client"=> $clients]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("client/create", ["title" => "Cliente"]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        $validated = $request->validate([
            "name"=> "required",
            "last-name"=> "required",
            "whatsapp"=> "required",
        ]);
        $name = $validated["name"];
        $last_name = $validated["last-name"];
        $cpf = $request["cpf"]? $request["cpf"]: "";
        $email = $request["email"]? $request["email"]: "";
        $whatsapp = $validated["whatsapp"];
        $whatsapp = whatsappNumber($whatsapp);
        
        $send = Client::create([
            "First_Name" => $name,
            "Last_Name" => $last_name,
            "Cpf" => $cpf,
            "Email" => $email,
            "Whatsapp" => $whatsapp,
            "Status" => 1,
        ]);
        if ($send) {
            return redirect()->back()->with("success","Cliente cadastrado com sucesso!");
        }
        return redirect()->back()->with("error","Erro! Avise ao administrador.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
