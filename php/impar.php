<?php

$num = readline("NUMERO: ");

function impar($numero){
    return $numero % 2 != 0;
}

echo impar($num) ? 'O numero é impar' : 'O numero é par';