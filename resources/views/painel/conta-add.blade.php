@extends('painel.template') @section('title','Conta') @section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Cadastro: Contas</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="/">Início</a></li>
        <li class="breadcrumb-item"><b>Cadastro: Contas</b></li>
    </ul>
</div>

<!-- Button que ativa o Cadastro(Modal) -->

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="float-right">
                    <p>
                        <button type="button" class="btn btn-primary fa fa-user-plus" data-toggle="modal" data-target="#CadastroModal"> Cadastrar</button>
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="DataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Título</th>
                                <th>Valor</th>
                                <th>Situação</th>
                                <th>Data(Vencimento)</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contas as $conta)
                            <tr>
                                <td class="idDataTabConta">{{$conta->id}}</td>
                                <td>
                                <?php 
                                $tipo = $conta->tipo;
                                switch ($tipo) {
                                   case 'D':
                                   echo "Despesa";
                                       break;

                                   case 'R':
                                   echo "Receita";
                                       break;

                                   case 'T':
                                   echo "Transferência";
                                       break;

                                   default:
                                   echo "Sem definição";
                                       break;
                               }
                                ?>
                                </td>

                                <td>{{$conta->titulo}}</td>

                                <td>R$ {{number_format($conta->valor, 2, ',', '.')}}
                                </td>
                                <td class="statusDataTabConta">
                                    {{$conta->efetivado ? "Liquidado" : "Em Aberto" }}
                                </td>

                                <td>
                                    {{date('d/m/Y',strtotime($conta->vencimento))}}
                                </td>

                                <td class="actionDataTabConta">
                                    <button type="button" class="btn btn-primary btn-sm fa fa-eye" data-toggle="modal" data-target="#VisualizarCadContaModal" 
                                    data-whatever-id="{{$conta->id}}" data-whatever-titulo="{{$conta->titulo}}" 
                                    data-whatever-categoria="{{$conta->categoria_fk}}" data-whatever-pasta="{{$conta->pasta_fk}}" 
                                    data-whatever-valor="{{"R$".number_format($conta->valor,2,',', '.')}}"
                                    data-whatever-efetivado="{{$conta->efetivado ? "Liquidado" : "Em Aberto" }}" data-whatever-parcela="{{$conta->parcela}}"
                                    data-whatever-dataconta="{{date('d/m/Y',strtotime($conta->data_conta))}}"
                                    data-whatever-dataefetivado="{{$conta->data_efetivacao ? date('d/m/Y',strtotime($conta->data_efetivacao)) : "Não foi pago"}}"
                                    data-whatever-datavencimento="{{$conta->vencimento ? date('d/m/Y',strtotime($conta->vencimento)) : "Não preenchido"}}""
                                    
                                    data-whatever-tipo=" <?php 
                                    $tipo = $conta->tipo;
                                    switch ($tipo) {
                                       case 'D':
                                       echo "Despesa";
                                           break;
    
                                       case 'R':
                                       echo "Receita";
                                           break;
 
                                       case 'T':
                                       echo "Transferência";
                                           break;   

                                       default:
                                       echo "Sem definição";
                                           break;
                                   }
                                    ?>" 
                                > Visualizar</button>
                                    <button type="button" class="btn btn-alterar btn-sm fa fa-money" data-toggle="modal" data-target="#AlterarCadContaModal"
                                    data-whatever-id="{{$conta->id}}" data-whatever-titulo="{{$conta->titulo}}" 
                                    data-whatever-valor="{{"R$".number_format($conta->valor,2,',', '.')}}"
                                    data-whatever-efetivado="{{$conta->efetivado}}" data-whatever-parcela="{{$conta->parcela}}"
                                    data-whatever-dataconta="{{date('d/m/Y',strtotime($conta->data_conta))}}"
                                    data-whatever-dataefetivado="{{date('d/m/Y',strtotime($conta->data_efetivacao))}}"
                                    data-whatever-datavencimento="{{$conta->vencimento ? date('d/m/Y',strtotime($conta->vencimento)) : "Não preenchido"}}""
                                    
                                    data-whatever-tipo=" <?php 
                                    $tipo = $conta->tipo;
                                    switch ($tipo) {
                                       case 'D':
                                       echo "Despesa";
                                           break;
    
                                       case 'R':
                                       echo "Receita";
                                           break;

                                       case 'T':
                                       echo "Transferência";
                                           break;
    
                                       default:
                                       echo "Sem definição";
                                           break;
                                   }
                                    ?>" @if (!empty($conta) && $conta->efetivado==true) disabled @endif  > Baixa</button>
                                    <button data-whatever-id="{{$conta->id}}" type="button" class="btn btn-danger btn-sm fa fa-trash-o"
                                    data-toggle="modal" data-target="#modal-danger" > Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Exclusao-->
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="b_delete_modalHeader">
                <div class="modal-header">
                    <h4 class="b_text_modal_title_danger"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{action('ContaController@destroy')}}">
                    @csrf
                    <input type="hidden" class="form-control col-form-label-sm" id="iddelete" name="iddelete">
                    <label class="b_text_modal_danger">Deseja realmente excluir este registro?</label>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary btn-sm fa fa-times" data-dismiss="modal"> Cancelar</button>
                        <button type="submit" class="btn btn-delete btn-sm fa fa-trash-o"> Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal de Visualizar -->
<div class="modal fade" id="VisualizarCadContaModal" tabindex="-1" role="dialog" aria-labelledby="VisualizarCadContaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="b_view_modalHeader">
                <div class="modal-header">
                    <h5 class="modal-title" id="VisualizarCadContaModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-vertical">
                    @csrf

                    

                    <div class="form-group row">

                        <div class="col-sm-3">
                        <label for="recipient-name" class="control-label">ID</label>
                        <input type="text" class="form-control" id="id_conta" disabled=""> 
                        </div>

                        <div class="col-sm-3">
                        <label for="recipient-name" class="control-label">Categoria</label>
                        <select class="form-control" name="categoria" disabled>
                            @foreach ($categorias as $categoria)
                            <option value={{$categoria->id}} @if ($conta->categoria_fk == $categoria->id)
                                selected @endif>{{$categoria->nome}}</option>
                            @endforeach
                        </select>
                        </div>
                        
                        <div class="col-sm-3">
                        <label for="recipient-name" class="control-label">Pasta</label>
                        <select class="form-control" name="pasta" disabled>
                            @foreach ($pastas as $pasta)
                            <option value={{$pasta->id}} @if ($conta->pasta_fk == $pasta->id)
                                selected @endif>{{$pasta->nome}}</option>
                            @endforeach
                        </select>
                        </div>
                        
                        <div class="col-sm-3">
                        <label for="recipient-name" class="control-label">Situação</label>
                        <p><input type="text" class="form-control" id="efetivado_conta" disabled=""> </p>
                        </div>

                        <!-- Segunda Linha -->
                        <div class="col-sm-6">
                        <label for="recipient-name" class="control-label">Descrição</label>
                        <input type="text" class="form-control" id="titulo_conta" disabled=""> 
                        </div>
                        
                        <div class="col-sm-3">
                        <label for="recipient-name" class="control-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo_conta" disabled=""> 
                        </div>
                        
                        
                        <div class="col-sm-3">
                        <label for="recipient-name" class="control-label">Valor</label>
                        <p><input type="text" class="form-control" id="valor_conta" disabled=""> </p>
                        </div>
                        
                        <!-- Terceira Linha -->
                        <div class="col-sm-4">
                        <label for="recipient-name" class="control-label">Data Venc.</label>
                        <input type="text" class="form-control" id="vencimento_conta" disabled="">
                        </div>

                        <div class="col-sm-4">
                        <label for="recipient-name" class="control-label">Data Pag.</label>
                        <input type="text" class="form-control" id="dataefe_conta" disabled="">
                        </div>

                        <div class="col-sm-4">
                        <label for="recipient-name" class="control-label">Data Cadastro</label>
                        <input type="text" class="form-control" id="data_conta" disabled="">
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-delete" data-dismiss="modal"><i class="fa fa-times"> Fechar</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Alteracao -->
<div class="modal fade" onload="uuuu();" id="AlterarCadContaModal" tabindex="-1" role="dialog" aria-labelledby="AlterarCadContaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="b_edit_modalHeader">
                <div class="modal-header">
                    <h5 class="modal-title" id="AlterarCadContaModalLabel">Alterar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{action('ContaController@update')}}">
                    @csrf

                    <div class="form-group row">
                        
                        <div class="col-md-8">
                            <input type="hidden" class="form-control col-form-label-sm" id="id_contaalt" name="id_conta">
                        </div>
                        
                    </div>
                     
                    <div class="form-group row">

                        <label for="recipient-name" class="col-form-label col-md-3">Descrição</label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" id="titulo_contaalt" disabled="">
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="recipient-name" class="col-form-label col-md-3">Parcela</label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" id="parcela_conta" disabled="">
                        </div>

                    </div>
                     

                <div  class="form-group row" id="dataefetivado">

                        <label for="recipient-name" class="col-form-label col-md-3">Pago no dia</label>
                        <div class="col-md-8" >
                        <input type="date" class="form-control" id="dataefetivado_conta" name="data_efetivacao" >
                        <label class="control-label">**Se estiver em branco será considerado o dia atual**</label>
                        </div>

                    </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Cancelar</i></button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o "> Dar Baixa</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cadastro-->
<div class="modal fade" id="CadastroModal" tabindex="-1" role="dialog" aria-labelledby="CadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="b_add_modalHeader">
                <div class="modal-header">
                    <h5 class="modal-title" id="CadastroModalLabel">Nova Conta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">

                <!-- Form de cadastro -->
                <form class="form-horizontal" method="POST" action="{{action('ContaController@store')}}">
                    @csrf

                    <div class="form-group row">
                        <label class="control-label col-md-3">Tipo</label>
                        <div class="col-md-8">
                            <select class="form-control" name="tipo">
                                <option value="D">Despesa</option>
                                <option value="R">Receita</option>
                                <option value="T">Transferência</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Categoria</label>
                        <div class="col-md-8">
                            <select class="form-control" name="categoria">
                                @foreach ($categorias as $categoria)
                                <option value={{$categoria->id}}>{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Pasta</label>
                        <div class="col-md-8">

                            <select class="form-control" name="pasta">
                                @foreach ($pastas as $pasta)
                                <option value={{$pasta->id}}>{{$pasta->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Titulo</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="titulo" placeholder="Descreva a conta.." required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Valor</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" name="valor" placeholder="0,00" step="0.01" required>
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label class="control-label col-md-3">Efetivado</label>
                        <div class="col-md-8">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="efetivado1" value="1" name="efetivado">
                                <label for="efetivado1" class="custom-control-label"> Sim</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" checked type="radio" id="efetivado2" value="0" name="efetivado">
                                <label for="efetivado2" class="custom-control-label"> Não</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Parcelas</label>
                        <div class="col-md-8">
                            <select class="form-control" name="parcela">
                                @foreach (range(1,48) as $parcela)
                                <option value="{{$parcela}}">{{$parcela}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3">Vencimento</label>
                        <div class="col-md-8">
                            <input class="form-control" type="date" name="venc" placeholder="Select Date">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Intervalo ( em dias entre vencimentos)</label>
                        <div class="col-md-8"> 
                            <input class="form-control" type="text" name="intervalo">
                            <label class="control-label">**Se estiver em branco será considerado 30 dias (corridos)**</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Cancelar</i></button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"> Salvar</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection