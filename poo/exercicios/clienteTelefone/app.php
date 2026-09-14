<?php

namespace poo\exercicios\clienteTelefone;
use poo\exercicios\clienteTelefone\Cliente;
use poo\exercicios\clienteTelefone\Conexao;
use poo\exercicios\clienteTelefone\Telefone;
use PDOException;

require_once "Conexao.php";
require_once "RepositorioClienteEmBDR.php";
require_once "Cliente.php";
require_once "Telefone.php";
require_once "RepositorioException.php";

try{
    $conexao = Conexao::getConexao();

    $repositorio = new RepositorioClienteEmBDR($conexao);
}catch(PDOException $e){
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit;
}

$OPCOES = [
    1 => "Adicionar cliente",
    2 => "Atualizar cliente",
    3 => "Remover cliente",
    4 => "Listar clientes",
    5 => "Sair"
];

$opcaoEscolhida = (int)readline("Escolha uma opção:\n" . implode("\n", array_map(fn($k, $v) => "$k - $v", array_keys($OPCOES), $OPCOES)) . "\n> ");

if(!array_key_exists($opcaoEscolhida, $OPCOES)){
    echo "Opção inválida. Encerrando o programa.\n";
    exit;
}

function adicionarTelefones(): array {
    $telefones = [];
    while(true){
        $numero = readline("Número do telefone (ou 'sair' para finalizar): ");
        if(strtolower($numero) === 'sair') break;
        $idTelefone = count($telefones) + 1;
        $telefones[] = new Telefone($idTelefone, $numero);
    }

    // Validar DEPOIS
    foreach($telefones as $tel) {
        $problemas = $tel->validar();
        if(!empty($problemas)) {
            echo "Telefone inválido: " . implode(", ", $problemas) . "\n";
            return [];  // Retorna vazio se houver erro
        }
    }
    return $telefones;
}
try{
    switch($opcaoEscolhida){
        case 1:
            echo "Adicionando cliente...\n";
                $nome = readline("Nome do cliente: ");
                $telefones = adicionarTelefones();
                if(empty($telefones)) {
                    echo "Nenhum telefone foi adicionado!\n";
                    break;
                }
                $cliente = new Cliente(0, $nome, $telefones);
                $problemas = $cliente->validar();
                if(!empty($problemas)){
                    echo "Problemas encontrados:\n" . implode("\n", $problemas) . "\n";
                    exit;
                }
                $repositorio->adicionar($cliente);
            echo "Cliente adicionado com sucesso!\n";
            break;
        case 2:
            echo "Atualizando cliente...\n";
                $id = (int)readline("ID do cliente: ");
                $nome = readline("Novo nome do cliente: ");
                $telefones = adicionarTelefones();
                if(empty($telefones)) {
                    echo "Nenhum telefone válido foi adicionado!\n";
                    break;
                }
                $cliente = new Cliente($id, $nome, $telefones);
                $problemas = $cliente->validar();
                if(!empty($problemas)){
                    echo "Problemas encontrados:\n" . implode("\n", $problemas) . "\n";
                    exit;
                }
                $repositorio->atualizar($cliente);
            echo "Cliente atualizado com sucesso!\n";
            break;
        case 3:
            echo "Removendo cliente...\n";
                $id = (int)readline("ID do cliente: ");
                $repositorio->remover($id);
            echo "Cliente removido com sucesso!\n";
            break;
        case 4:
            echo "Listando clientes...\n";
                $clientes = $repositorio->todos();
                foreach($clientes as $cliente){
                    $telefones = implode(", ",
                                        array_map(
                                            fn($tel) => $tel->getNumero(),
                                            array_slice($cliente->telefones, 0, 2)
                                        ));

                    echo "ID: {$cliente->getId()}, Nome: {$cliente->getNome()}, Telefones: $telefones\n";
                }
            break;
        case 5:
            echo "Saindo do programa.\n";
            exit;
    }
}catch(RepositorioException $e){
    echo "Erro: " . $e->getMessage() . "\n";
}catch(\Exception $e){
    echo "Erro inesperado: " . $e->getMessage() . "\n";
}
