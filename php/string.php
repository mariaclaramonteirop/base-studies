<?php


$x = 10;

$string = '\t O valor de x é $x\n';
$string2 = "\t O valor de x é $x\n";
$string3 = "\t O valor de x é {$x}\n";


$sql = <<<SQL
    PODE ESCREVER LIVREMENTE
    $string
SQL; // HERE DOC -> INTERPRETA VARIÁVEIS

//NOW DOC

$sql2 = <<<'SQL'
    PODE ESCREVER LIVREMENTE 
SQL; // NOW DOC -> NÃO INTERPRETA VARIÁVEIS