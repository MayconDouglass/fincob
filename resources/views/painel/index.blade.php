@extends('painel.template')

@section('title','DashBoard')

@section('content')
    

<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Início</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="/">Início</a></li>
  </ul>
</div>
<div class="row">
  
  <div class="col-md-6 col-lg-4">
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Clientes</h4>
        <p><b>0</b></p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-4">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
      <div class="info">
        <h4>Pedidos</h4>
        <p><b>0</b></p>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-4">
    <div class="widget-small warning coloured-icon"><i class="icon fa fa-cubes fa-3x"></i>
      <div class="info">
        <h4>Produtos</h4>
        <p><b>0</b></p>
      </div>
    </div>
  </div>

  

</div>
@endsection