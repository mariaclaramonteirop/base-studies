<?php
require_once 'src/Compromisso.php';
require_once 'fabrica.php';

$id = htmlspecialchars($_POST['id'] ?? '');
$descricao = htmlspecialchars($_POST['descricao'] ?? '');
$data = htmlspecialchars($_POST['data'] ?? '');
$hora = htmlspecialchars($_POST['hora'] ?? '');
$status = StatusCompromisso::tryFrom(
    htmlspecialchars($_POST['status'] ?? 'A'));

$compromisso = null;
try{
    $compromisso = new Compromisso(
        (int)$id,
        $descricao,
        $data,
        $hora,
        $status
    );
}catch(RuntimeException $e){
    http_response_code(400);
    die($e->getMessage());
}

try{
    $repositorio = gerarRepositorio();
    $id = $repositorio->adicionar($compromisso);

    if($id !== null){

    }

    header('Location: index.php');
}catch(RepositorioException|PDOException $e){
    http_response_code(500);
    die('Erro ao adicionar compromisso: ' . $e->getMessage());
}