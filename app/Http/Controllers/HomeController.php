<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\CashBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = [
            "balanceBefore" => 0,
            "buy" => 0,
            "expense" => 0,
            "revenue" => 0,
            "currentCash" => 0,
        ];

        $id = Auth::user()->Id_Company;
        $cash = Cash::where('Cash_Date',date('Y-m-01'))->first();

        if($cash){
            $data['balanceBefore'] = floatval($cash->Balance_Before); 
            $book = CashBook::where('Id_Cash', $cash->id)->get();
            foreach($book as $index){
                if($index['Type_Cash_Book']){
                    $data['revenue'] += floatval($index['Value_Cash_Book']);
                }else{
                    $data['expense'] += floatval($index['Value_Cash_Book']);

                }

                }
            }
        
        $data['currentCash'] = floatval($data['balanceBefore']) + ($data['revenue'] - $data['expense']);

        return view('home',['title'=> 'Painel', 'data' => $data]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
