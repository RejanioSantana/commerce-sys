<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Services\NFCE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $c = User::select('Id_Company')->where('id',Auth::user()->id)->first();
        $c = Company::where('id',$c->Id_Company)->first();
        return view('company/index',["title"=>"Perfil Empresa", "data" => $c]);
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
        try {
            $r = $request->validate([
                'name' => 'required',
                'name_fantasy' => 'required',
                'cnpj' => 'required',
                'phone' => 'required',
                'ie' => 'required',
                'icms' => 'required',
            ]);
            $name =  strtoupper($r['name']);
            $fantasy =  strtoupper($r['name_fantasy']);
            $cnpj = (strlen($r['cnpj'])== 14)? intval($r['cnpj']): 0;
            
            $phone = intval($r['phone']);
            $ie =  intval($r['ie']);
            $icms =  floatval($r['icms']);
            $nfe = ($request['nfce'] == 'on')? 1 : 0;
            $reponse = Company::where('id', Auth::user()->Id_Company)->update([
                'Name_Company' => $name,
                'Name_Fantasy' => $fantasy,
                'Cnpj' => $cnpj,
                'Phone' => $phone,
                'IE' => $ie,
                'ICMS' => $icms,
                'Nfe' => $nfe,
            ]);
            if($reponse){
                return redirect()->back()->with('success','Dados atualizados.');
            }
            return redirect()->back()->with('error','Dados não atualizados.');

        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error','Dados não atualizados.');
        }

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
