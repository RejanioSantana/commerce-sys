<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user'=> 'required',
            'password'=> 'required',
        ]);
        // dd($request->password);
        $pass = $validated['password'];

        $logged= Auth::attempt(['User_Code' =>$request->user,'password' => $pass]);
        if ($logged) {
            return redirect()->intended('/');
        }
        return back()->with('error_login','Usuário ou Senha incorreto, tente novamente.');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
