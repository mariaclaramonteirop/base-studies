<?php

require_once 'maiorDeDois.php';

$x1 = readline( "Primeiro:" );
$y1 = readline( "Segundo:" );
$z1 = readline( "Terceiro:" );

function maiorDeTres($x, $y, $z){

    maiorDeDois($x, maiorDeDois($y, $z));
}

echo maiorDeTres($x1, $y1, $z1);