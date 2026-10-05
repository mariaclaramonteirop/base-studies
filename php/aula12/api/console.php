<?php

require_once __DIR__ . '/src/RepositorioException.php';
require_once __DIR__ . '/src/ServicoCadastroCidade.php';
require_once __DIR__ . '/src/infra/RepositorioCidadesEmPDO.php';
require_once __DIR__ . '/src/infra/RepositorioEstadosEmPDO.php';
require_once __DIR__ . '/src/DominioException.php';



$pdo = new PDO('mysql:host=localhost;dbname=aula12', 'root', '');

$servico = new ServicoCadastroCidade(
    new RepositorioEstadosEmPDO($pdo),
    new RepositorioCidadeEmPDO($pdo)
);

echo 'CADASTRO DE CIDADE:', PHP_EOL;

$cidade = [];
$cidade['nome'] = readline('Nome da cidade: ');
$cidade['uf'] = readline('UF do estado: ');

try{
    $servico->salvar($cidade);
    echo 'Cidade cadastrada com sucesso!', PHP_EOL;
}catch(DominioException $e){
    echo 'Erro: ' . $e->getMessage();
}

