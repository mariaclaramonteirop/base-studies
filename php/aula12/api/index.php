<?php

require_once 'vendor/autoload.php';

use phputil\router\Router;

$pdo = new PDO('mysql:host=localhost;dbname=aula12', 'root', '');

$servico = new ServicoCadastroCidade(
    new RepositorioEstadosEmPDO($pdo),
    new RepositorioCidadeEmPDO($pdo)
);

$app = new Router();

$app->get('/', function( $req, $res){
    $res->send('Listando cidades');
});

$app->post('/cidade', function( $req, $res) use ($servico){
    try{
        $dados = (array)$req->body();
        $servico->salvar($dados);
        $res->status(201)->json(['message' => 'Cidade cadastrada com sucesso!']);
    } catch (DominioException $e) {
        $res->status(400)->json([$e->getMessage()]);
    } catch (Exception $e) {
        $res->status(500)->json($e->getMessage());
    }
});
$app->listen();