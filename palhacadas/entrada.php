<?php

// identificar o método de requisição
$metodo = $_SERVER['REQUEST_METHOD'];
$tipoContent = $_SERVER['CONTENT_TYPE'];

$dadosRecebidos = [];

if($metodo == 'GET'){
    // Se for GET, receber o parâmetro nome pela URL.
    $nome = $_GET['nome'] ?? null;
    $idade = $_GET['idade'] ?? null;

} else if($metodo == 'POST' && $tipoContent == 'application/json'){
    // Se for POST com JSON, receber o parâmetro nome pelo corpo da requisição.
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $nome = $data['nome'] ?? null;
    $idade = $data['idade'] ?? null;

} else {
    // Se for POST, receber o parâmetro nome pelo corpo da requisição.
    $nome = $_POST['nome'] ?? null;
    $idade = $_POST['idade'] ?? null;
}

$dadosRecebidos = [
    'nome' => $nome ?? null,
    'idade' => $idade ?? null
];

echo json_encode($dadosRecebidos);