<?php


function acrecimoQuinzePorCentoEmNovoArray ($arrayProdutos){
    $novoArray = [];

    foreach($arrayProdutos as $p){
        $novoArray[] = $p * 1.15;
    }

    return $novoArray;
}

function contagemEletronicosEmArray($categorias){
    $contagem = 0;

    foreach($categorias as $c){
        if($c === "Eletrônicos") {
            $contagem++;
        }
    }

    return $contagem;
}

function limpaEOrdenaArray($arrayIds){
    $limpos = array_unique($arrayIds);
    rsort($limpos);

    return $limpos;

}
// forma alternativa de fazer a função limpaEOrdenaArray
function limpaEOrdenaArray2($arrayIds){
    $limpos = [];

    foreach($arrayIds as $id){
        if(!in_array($id, $limpos)){
            $limpos[] = $id;
        }
    }

    rsort($limpos);

    return $limpos;
}

// outra forma de ordenar o array manualmente, sem usar a função rsort
function limpaEOrdenaArray3($arrayIds){
    $limpos = array_values(array_unique($arrayIds));
    $tamanho = count($limpos);

    for ($i = 0; $i < $tamanho - 1; $i++) {
        for ($j = 0; $j < $tamanho - 1 - $i; $j++) {
            if ($limpos[$j] < $limpos[$j + 1]) {
                // Troca os elementos de posição
                $temp = $limpos[$j];
                $limpos[$j] = $limpos[$j + 1];
                $limpos[$j + 1] = $temp;
            }
        }
    }

    return $limpos;
}

// Dado um array representando o domínio de uma função matemática,
// escreva um script que aplique a função f(x)= 2x^2 − 3x + 1 a cada elemento
// e retorne um novo array contendo a imagem (os resultados calculados).
function equacaoQuadraticaPeloDominio($dominio){
    $imagem = [];

    foreach($dominio as $x){
        $resultado = 2 * pow($x, 2) - 3 * $x + 1;
        $imagem[] = $resultado;
    }

    return $imagem;
}

function faixasDeIdades($idades){
    $menores = [];
    $maiores = [];
    $idadesNovos = [];

    foreach($idades as $i){

        if($i >= 0 && $i < 18){
            $menores[] = $i;
        }else if ($i >= 18) {
            $maiores[] = $i;
        }else {
            echo "Idade invalida encontrada: " . $i ;
        }

    }
        $idadesNovos = [
            "maiores" => $maiores,
            "menores" => $menores
        ];

    return $idadesNovos;
}