<?php

    require_once 'maiorDeDois.php';

$idade = [
    14,
    20,
    39,
    60
];




function maiorDoArray($idade){
    // $maior = 0;
    $contagem = count($idade);

    $maior = $contagem < 1 ? false : $idade[0];


    // foreach($idade as $valor){
    //     $maior = maiorDeDois($valor, $maior);

    // }

    for($i=1 ; $i < $contagem; $i ++){
        $maior = maiorDeDois($maior, $idade[$i]);
    }

        return $maior;

}

echo maiorDoArray($idade);