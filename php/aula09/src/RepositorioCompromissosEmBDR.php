<?php

use poo\exercicios\clienteTelefone\RepositorioException;
require_once 'RepositorioCompromissos.php';
require_once 'RepositorioException.php';

class RepositorioCompromissosEmBDR implements RepositorioCompromissos{


    public function __construct(private PDO $pdo){}

    public function todos(string $pesquisa = ''):array{
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM compromissos WHERE descricao LIKE ?');
            $stmt->execute([
                "%" . $pesquisa . "%"
            ]);

            $compromissos = [];

            foreach($stmt as $c){
                $compromissos = new Compromisso(
                    $c['id'],
                    $c['descricao'],
                    $c['data'],
                    $c['hora'],
                    StatusCompromisso::tryFrom($c['status'])
                );
            }

            return $compromissos;

        }catch(PDOException $e){
            throw new RepositorioException('Erro ao obter compromissos');
        }
    }
    public function adicionar(Compromisso $compromisso){
        $novo = $compromisso->id == 0;
        try{
            $sql = '';
            $param = [
                'descricao' => $compromisso->descricao,
                'data' => $compromisso->data,
                'hora' => $compromisso->hora,
                'status' => $compromisso->status->value
            ];

            if($novo){
                $sql = 'INSERT INTO compromissos (descricao, data, hora, status) VALUES (:descricao, :data, :hora, :status)';
            }else{
                $sql = 'UPDATE compromissos SET descricao = :descricao, data = :data, hora = :hora, status = :status WHERE id = :id';
                $param['id'] = $compromisso->id;
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($param);

           if($novo){
                return (int)$this->pdo->lastInsertId();
            }

            return $stmt->rowCount() > 0 ? $compromisso->id : null;



        }catch(PDOException $e){
            throw new RepositorioException('Erro ao adicionar compromisso', 0, $e);
        }
    }
    public function removerPeloId(int $id):bool{
        try{
            $stmt = $this->pdo->prepare('DELETE FROM compromisso WHERE id = :id');
            $stmt->execute([
                'id' => $id
            ]);

            return $stmt->rowCount() > 0;
        }catch(PDOException $e){
            throw new RepositorioException('Não foi possivel remover.', 0 , $e);
        }
    }
}