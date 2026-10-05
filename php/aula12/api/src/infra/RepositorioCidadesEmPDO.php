<?php
require_once __DIR__ . '/../RepositorioCidade.php';
require_once __DIR__ . '/../RepositorioException.php';
require_once __DIR__ . '/../Cidade.php';


class RepositorioCidadeEmPDO implements RepositorioCidade{

    public function __construct(
        private PDO $pdo
        ){   }

    public function adicionar(Cidade $cidade): void
    {
        try{
            $sql = 'INSERT INTO cidade (nome, estado) VALUES (:nome, :estado_id)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $cidade->nome,
                ':estado_id' => $cidade->estado->id
            ]);

            $cidade->id = (int) $this->pdo->lastInsertId();
        }catch(Exception $e){
            throw new RepositorioException('Erro ao adicionar Cidade', 0, $e);
        }
    }

    public function atualizar(Cidade $cidade): bool
    {
        try{
            $sql = 'UPDATE cidade SET nome = :nome, estado = :estado_id WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $cidade->id,
                ':nome' => $cidade->nome,
                ':estado_id' => $cidade->estado->id
            ]);

            return $stmt->rowCount() > 0;
        }catch(Exception $e){
            throw new RepositorioException('Erro ao atualizar Cidade', 0, $e);
        }
    }

    public function obterIdCidadeComNome(string $nome): Cidade
    {
        try{
            $sql = 'SELECT id FROM cidade where nome = :nome';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome
            ]);

            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$r) {
                return null;
            }

            return new Cidade($r['id'], $nome);
        }catch(Exception $e){
            throw new RepositorioException('Erro ao obter Cidade', 0, $e);
        }
    }
}