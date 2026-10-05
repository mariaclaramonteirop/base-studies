<?php
require_once 'RepositorioCompromissosEmBDR.php';
require_once 'RepositorioCompromissos.php';
require_once 'fabrica.php';

$id = $_GET['id'] ?? '';

if($id == '' || is_numeric($id)){
    http_response_code(400);
    die('Por favor informe um id numerico como parametro.');
}

try{
    $repositorio = gerarRepositorio();
    $removeu = $repositorio->removerPeloId($id);

    if($removeu){
        echo 'Removido com sucesso';
    }else{
        http_response_code(404); // Not Found -> Não encontrado
        die('Não encontrado.');
    }
}catch(Exception $e){
    http_response_code(500);
    die('Erro ao remover: ' . $e->getMessage());
}