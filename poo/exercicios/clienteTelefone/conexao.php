<?php

namespace poo\exercicios\clienteTelefone;
use PDO;

class Conexao{
    private static ?\PDO $conexao = null;

    public function __construct(
        private \PDO $pdo
    )
    {}
    public static function getConexao(): \PDO{
        if(self::$conexao === null){
            self::$conexao = new \PDO(
                "mysql:host=localhost;dbname=acme1;charset=utf8",
                "root",
                ""
            );
        }
        return self::$conexao;
    }

    public static function setConexao(\PDO $pdo): void{
        self::$conexao = $pdo;
    }

    public static function fecharConexao(): void{
        self::$conexao = null;
    }

    public function beginTransaction(): void{
        $this->pdo->beginTransaction();
    }

    public function commit(): void{
        $this->pdo->commit();
    }

    public function rollBack(): void{
        $this->pdo->rollBack();
    }
}