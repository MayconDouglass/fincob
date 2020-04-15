<?php

use Illuminate\Http\Request;
//Arredondar X casas decimais
$valor = $_GET[$request->valor];

converterDinheiro($valor);

function converterDinheiro($valor){
    echo number_format($valor,2, '.', ',');
}

?>