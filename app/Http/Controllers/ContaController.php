<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conta;
use App\Models\UsuariosConta;
use App\Models\Categoria;
use App\Models\Pasta;

use Auth;
use DateTime;
use DateInterval;

class ContaController extends Controller
{
    public function index()
    {
       
    }

    public function show()
    {

    }

    public function create()
    {
        $conta = Conta::first();
        //dd($conta);
        $contas = Auth::user()->contas;
        $categorias = Categoria::orderby('nome')->get();
        $pastas = Pasta::orderby('nome')->get();
        return view('painel.conta-add', compact('contas','conta','categorias','pastas'));
    }
      

    public function store(Request $request){

            if($request->parcela > 1 ){
            
                foreach(range(1, $request->parcela) as $parcela){
                   
                    
                    $date = date('Y-m-d H:i:s',strtotime($request->venc ??  date('Y-m-d H:i:s')));
                    $date2 = date('d',strtotime($request->venc));
                    
                    $dia = $request->intervalo ?? 30; 
                    $days = ($parcela-1) * $dia ; //pegar o mês digitado
                    $year_month = Date("Y-m-d", strtotime($date));

                    $year_month_incremented = Date("Y-m-d", strtotime($year_month . " +{$days} days "));
                    
                    
                    $conta = new Conta;
                    $conta->tipo = $request->tipo[0];
                    $conta->titulo = $request->titulo . "  //  Parcela ( {$parcela} / {$request->parcela} )";
                    $conta->valor = ($request->valor / $request->parcela);
                    $request->efetivado ? $conta->efetivado = 1 : $conta->efetivado = 0;
                    $conta->parcela = $parcela;
                    $conta->categoria_fk = $request->categoria;
                    $conta->pasta_fk = $request->pasta;
                    $conta->data_conta = date('Y-m-d H:i:s');
                    $conta->vencimento = $year_month_incremented;
                   
                    $conta->save();

                    $uc = new UsuariosConta;
                    $uc->usuario_pfk = Auth::user()->id;
                    $uc->conta_pfk = Conta::orderBy('id','desc')->first()->id;
                    $uc->save();
                    
                }
            
                return redirect()->action('ContaController@create');

            }else{
                    $conta = new Conta();
                    $conta->tipo = $request->tipo;
                    $conta->titulo = $request->titulo . "  //  ( 1 / 1 )";
                    $conta->valor = $request->valor;
                    $conta->efetivado = $request->efetivado;
                    $conta->parcela = $request->parcela;
                    $conta->categoria_fk = $request->categoria;
                    $conta->pasta_fk = $request->pasta;
                    $conta->data_conta = date('Y-m-d H:i:s');
                    $conta->vencimento = date('Y-m-d H:i:s',strtotime($request->venc ??  date('Y-m-d H:i:s')));
                    // dd($c);
                    $conta->save();   
                    $uc = new UsuariosConta;
                    $uc->usuario_pfk = Auth::user()->id;
                    $uc->conta_pfk = Conta::orderBy('id','desc')->first()->id;
                    $uc->save();
                    return redirect()->action('ContaController@create');

            } 
        
    }
    public function edit($id){
        
        $conta = Conta::find($id);
        $contas = Conta::all();

        if($conta)
            return view('painel.conta-add', compact('contas','conta'));
        else
            return redirect()->action('ContaController@create');
    }

    public function update(Request $request)
    {
            $conta = Conta::find($request->id_conta);
            $request->data_efetivacao ? $conta->data_efetivacao = $request->data_efetivacao : $conta->data_efetivacao = date('Y-m-d H:i:s') ;
            $conta->efetivado = 1;
            //dd($u);
            $update = $conta->save();  
            if($update)
            return redirect()->action('ContaController@create');
       
    }

    public function destroy(Request $request)
    {
        $conta = Conta::find($request->iddelete);
        $conta->delete();

        return redirect()->action('ContaController@create');
    }


}
