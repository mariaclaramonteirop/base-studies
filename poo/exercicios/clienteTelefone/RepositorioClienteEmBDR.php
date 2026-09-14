<?php

namespace poo\exercicios\clienteTelefone;
use poo\exercicios\clienteTelefone\Cliente;
use poo\exercicios\clienteTelefone\Telefone;
use poo\exercicios\clienteTelefone\RepositorioCliente;
use poo\exercicios\clienteTelefone\RepositorioException;

class RepositorioClienteEmBDR implements RepositorioCliente{

    public function __construct(
        private \PDO $pdo
    ){}
    public function adicionar(Cliente $cliente): void{
        try{
            $sqlCliente = "INSERT INTO cliente (id, nome) VALUES (:id, :nome)";
            $stmt = $this->pdo->prepare($sqlCliente);
            $stmt->execute([
                ':id' => $cliente->getId(),
                ':nome' => $cliente->getNome()
            ]);

            $sqlClienteTelefone = "INSERT INTO cliente_telefone (id, cliente_id, numero) VALUES (:id, :cliente_id, :numero)";
            $stmt = $this->pdo->prepare($sqlClienteTelefone);
            foreach($cliente->getTelefones() as $telefone){
                $stmt->execute([
                    ':id' => $telefone->getId(),
                    ':cliente_id' => $cliente->getId(),
                    ':numero' => $telefone->getNumero()
                ]);
            }
        } catch (\PDOException $e) {
            throw new RepositorioException("Erro ao adicionar cliente: " . $e->getMessage());
        }
    }

    public function atualizar(Cliente $cliente): void{
        try{
            $this->pdo->beginTransaction();
            $sqlCliente = "UPDATE cliente SET nome = :nome WHERE id = :id";
            $stmt = $this->pdo->prepare($sqlCliente);
            $stmt->execute([
                ':id' => $cliente->getId(),
                ':nome' => $cliente->getNome()
            ]);


            $sqlClienteTelefone = "UPDATE cliente_telefone SET numero = :numero WHERE id = :id AND cliente_id = :cliente_id";
            $stmt = $this->pdo->prepare($sqlClienteTelefone);
            foreach($cliente->getTelefones() as $telefone){
                $stmt->execute([
                    ':id' => $telefone->getId(),
                    ':cliente_id' => $cliente->getId(),
                    ':numero' => $telefone->getNumero()
                ]);
            }
            $this->pdo->commit();

        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            throw new RepositorioException("Erro ao atualizar cliente: " . $e->getMessage());
        }
    }

    public function remover(int $id): void{
        try{
            $sql = "DELETE FROM cliente WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw new RepositorioException("Erro ao remover cliente: " . $e->getMessage());
        }
    }

    public function todos(): array{
        try{
            $sqlCliente = "SELECT * FROM cliente";
            $stmt = $this->pdo->prepare($sqlCliente);
            $stmt->execute();

            $clientes = [];
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach($resultados as $resultado){
                $id = $resultado['id'];
                $nome = $resultado['nome'];

                $sqlClienteTelefone = "SELECT * FROM cliente_telefone WHERE cliente_id = :cliente_id";
                $stmtTelefone = $this->pdo->prepare($sqlClienteTelefone);
                $stmtTelefone->execute([
                    ':cliente_id' => $id
                ]);
                $telefones = [];
                $resultadosTelefone = $stmtTelefone->fetchAll(\PDO::FETCH_ASSOC);
                foreach($resultadosTelefone as $resultadoTelefone){
                    $telefoneId = $resultadoTelefone['id'];
                    $numero = $resultadoTelefone['numero'];
                    $telefones[] = new Telefone($telefoneId, $numero);
                }

                $clientes[] = new Cliente($id, $nome, $telefones);
            }
            return $clientes;
        } catch (\PDOException $e) {
            throw new RepositorioException("Erro ao buscar clientes: " . $e->getMessage());
        }
    }
}