<?php

namespace App;

use PDO;
use PDOException;


class Conexao
{
    private static $conexao;

    public static function getConexao()
    {
        try {
            if (!isset(self::$conexao)) {
                self::$conexao = new PDO("mysql:host=localhost;dbname=p1-2026.1", "root", "");
            }
            return self::$conexao;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            exit;
        }
    }
}