<?php

require_once __DIR__ . '/../RepositorioEstados.php';
require_once __DIR__ . '/../RepositorioException.php';
require_once __DIR__ . '/../Estado.php';


class RepositorioEstadosEmPDO implements RepositorioEstados{

    public function __construct(
        private PDO $pdo
        ){   }

    public function estadoComUf(string $uf): ?Estado
    {
        try{
            $sql = 'SELECT id, nome, uf FROM estado WHERE uf = :uf';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':uf' => $uf
            ]);

            $r = $stmt->fetch();

            if(!$r){
                return null;
            }

            return new Estado($r['id'], $r['nome'], $r['uf']);
        }catch(Exception $e){
            throw new RepositorioException('Erro ao obter Estado', 0, $e);
        }
    }
}