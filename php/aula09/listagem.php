<?php
require_once 'RepositorioCompromissosEmBDR.php';
require_once 'RepositorioCompromissos.php';
require_once 'fabrica.php';


function gerarLinhasCompromissos(string $pesquisa){
    try{
        $repositorio = gerarRepositorio();
        $compromissos = $repositorio->todos($pesquisa);

        desenharCompromissos($compromissos);

    }catch(PDOException|RepositorioException $e){
        echo 'Erro';
    }
}

/**
 * Desenhar as linhas de compromissos
 * @param Compromisso[] $compromissos
 * @return void
 */
function desenharCompromissos(array $compromissos):void{
    foreach($compromissos as $c){

        $horario = $c->data ." ". $c->hora;
        $status = match($c->status->value){
            'A' => 'Agendado',
            'R' => 'Realizado',
            'C' => 'Cancelado',
        };
        $remover = 'remover.php?id=' . $c->id;
        echo <<<HTML
                <tr>
                    <td>{$c->id}</td>
                    <td>{$c->descricao}</td>
                    <td>{$horario}</td>
                    <td>{$status}</td>
                    <td>< href='$remover'>Remover</a></td>
                </tr>
                HTML;
    }
}