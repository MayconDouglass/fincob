<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\User;
use Auth;
use Hash;

class LoginController extends Controller
{
    public function form()
    {
        if (Auth::user())
            return view('painel.index');
        else
            return view('login');
    }

    public function Login(Request $request)
    {
        //dd(bcrypt($request->password));

        $request->validate([
            'login' => 'required',
            'senha' => 'required'
        ]);


        $lembrar = empty($request->remember) ? false : true;

        $usuario = User::where('email', $request->login)->where('ativo',1)->first();
        //dd(bcrypt($request->senha));

        if ($usuario && Hash::check($request->senha, $usuario->password)) {
            
            Auth::loginUsingId($usuario->id, $lembrar);
        }

        return redirect()->action('LoginController@form');
    }

}
