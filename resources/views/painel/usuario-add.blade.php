@extends('painel.template') @section('title','Usuários') @section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-user-circle"></i> Cadastro: Usuários</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="/">Início</a></li>
        <li class="breadcrumb-item"><b>Cadastro: Usuários</b></li>
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
                                <th>Email</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <td class="idDataTabUser">{{$usuario->id}}</td>
                                <td>{{$usuario->email}}</td>
                                <td class="statusDataTabUser">
                                    <?php 
                      $status = $usuario->ativo;
                      If( $status > 0){
                        echo "Ativo";
                      }
                      else{
                        echo "Inativo";
                      }

                      ?>
                                </td>
                                <td class="actionDataTabUser">
                                  <button type="button" class="btn btn-primary btn-sm fa fa-eye" data-toggle="modal" data-target="#VisualizarCadModal" 
                                  data-whatever-id="{{$usuario->id}}" data-whatever-email="{{$usuario->email}}"
                                  data-whatever-pw="{{$usuario->password}}" 
                                  data-whatever-status="<?php 
                                  if($usuario->ativo > 0)
                                  echo "Ativo";
                                  else 
                                  echo "Inativo";
                                  
                                   ?>"
                                  > Visualizar</button>
                                  <button type="button" class="btn btn-alterar btn-sm fa fa-pencil-square-o" data-toggle="modal" data-target="#AlterarCadModal" 
                                  data-whatever-id="{{$usuario->id}}" data-whatever-email="{{$usuario->email}}"
                                  data-whatever-pw="{{$usuario->password}}" data-whatever-status="{{$usuario->ativo}}"
                                  > Alterar</button>
                                  <button data-whatever-id="{{$usuario->id}}" type="button" class="btn btn-danger btn-sm fa fa-trash-o"  data-toggle="modal" data-target="#modal-danger"> Excluir</button>           
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


 <!-- /.modal -->

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
            <form class="form-horizontal" method="POST" action="{{action('UsuarioController@destroy')}}">
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
  <!-- /.modal -->



<!-- Modal de Visualizar -->
<div class="modal fade" id="VisualizarCadModal" tabindex="-1" role="dialog" aria-labelledby="VisualizarCadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="b_view_modalHeader">
                <div class="modal-header">
                    <h5 class="modal-title" id="VisualizarCadModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    @csrf
            
                    <div class="form-group row">

                        <div class="col-sm-3">
                        <label for="recipient-name" class="control-label">ID</label>
                        <input type="text" class="form-control" id="id_user" disabled=""> 
                        </div>

                        <div class="col-sm-6">
                        <label for="recipient-name" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email_user" disabled=""> 
                        </div>
                        
                        <div class="col-sm-3">
                        <label for="recipient-name" class="control-label">Status</label>
                        <input type="text" class="form-control" id="status_user" disabled=""> 
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
<div class="modal fade" id="AlterarCadModal" tabindex="-1" role="dialog" aria-labelledby="AlterarCadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="b_edit_modalHeader">
                <div class="modal-header">
                    <h5 class="modal-title" id="AlterarCadModalLabel">Alterar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" action="{{action('UsuarioController@store')}}">
                @csrf
        
                <div class="form-group row">
                    <div class="col-md-8">
                        <input type="hidden" class="form-control" id="id_user" name="id_user">
                    </div>
                </div>
        
                <div class="form-group row">
        
                    <label for="recipient-name" class="col-form-label col-md-3 ">Email</label>
        
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="email_user" disabled="" name="email_user">
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="form_status" class="control-label col-md-3">Status</label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select class="form-control" id="statususer" name="statususer">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"> Cancelar</i></button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o "> Salvar</i></button>
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
                  <h5 class="modal-title" id="CadastroModalLabel">Novo Usuário</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          </div>
          <div class="modal-body">

              <!-- Form de cadastro -->
              <form class="form-horizontal" method="POST" action="{{action('UsuarioController@store')}}">
                  @csrf
                    <div class="form-group row">
                      <label class="control-label col-md-3">Email</label>
                      <div class="col-md-8">
                          <input class="form-control" type="email" name="email" placeholder="Digite um email válido" required>
                      </div>
                    </div>

                  <div class="form-group row">
                      <label class="control-label col-md-3">Senha</label>
                      <div class="col-md-8">
                          <input class="form-control" type="password" name="password" placeholder="Digite a senha" required>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="form_status" class="control-label col-md-3">Status</label>
                      <div class="col-md-8">
                          <div class="form-group">
                              <select class="form-control" id="form_status" name="ativo">
                                  <option value="1">Ativo</option>
                                  <option value="0">Inativo</option>
                              </select>
                          </div>
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