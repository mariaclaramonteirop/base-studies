<?php

    // require_once 'maiorDoArray.php';

$num = [
    1,
    2,
    3,
    9,
    90
];


function mediaDoArray ($numeros){

    $soma = 0;
    $quantidade = count($numeros);

    if($quantidade == 0){
        return; //trata o caso de array vazio, evitando divisão por zero
    }


    for($i = 0; $i<$quantidade; $i++ ){
        $soma += $numeros[$i];
    }

    return $soma / $quantidade;
}