<?php
require_once 'RepositorioCompromissosEmBDR.php';
require_once 'RepositorioCompromissos.php';

function conectar():PDO{
    return new PDO(
        'mysql:host=localhost;dbname=sistema;charset=utf8;', 'root',
        ''
    );
}

function gerarRepositorio():RepositorioCompromissos{
    return new RepositorioCompromissosEmBDR(conectar());
}