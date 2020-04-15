<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;

class UsuarioController extends Controller
{

   
    public function index()
    {
       
    }

    public function show()
    {

    }

    public function create()
    {
        $usuarios = Usuario::all();
     
        return view('painel.usuario-add', compact('usuarios'));

    }
   
    public function store(Request $request)
    {
        //dd($request->id_user);
        if($request->id_user)
        {
            $u = Usuario::find($request->id_user);
            $u->ativo = $request->statususer;
            //dd($u);
            $update = $u->save();  
            if($update)
            return redirect()->action('UsuarioController@create');
        }
        else
        {
            $u = new Usuario;
            $u->email = $request->email;
            $u->password = bcrypt($request->password);
            $u->ativo = $request->ativo;
            $u->save();   
            return redirect()->action('UsuarioController@create');
        }
            
        
    }
    public function edit($id){
        
        $usuario = Usuario::find($id);
        $usuarios = Usuario::all();

        if($usuario)
            return view('painel.usuario-add', compact('usuarios','usuario'));
        else
            return redirect()->action('UsuarioController@create');
    }

    public function update()
    {
       
    }

    public function destroy(Request $request)
    {
        //dd($request->all());
        $usuario = Usuario::find($request->iddelete);
        $usuario->delete();

        return redirect()->action('UsuarioController@create');
    }

}
