<?php

declare(strict_types=1);

class RepositorioException extends Exception {}

class Produto
{
    private int $id;
    private string $descricao;
    private float $preco;
    private int $totalEstoque;

    public function __construct(int $id, string $descricao, float $preco, int $totalEstoque)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->totalEstoque = $totalEstoque;
        $this->validar();
    }

    public function validar(): void
    {
        $erros = [];

        if ($this->id <= 0) {
            $erros[] = 'ID inválido. Deve ser maior que 0.';
        }

        if (mb_strlen(trim($this->descricao)) < 2 || mb_strlen(trim($this->descricao)) > 100) {
            $erros[] = 'Descrição inválida. Deve ter entre 2 e 100 caracteres.';
        }

        if ($this->preco <= 0.50) {
            $erros[] = 'Preço inválido. Deve ser maior que R$ 0,50.';
        }

        if ($this->totalEstoque < 0) {
            $erros[] = 'Total em estoque inválido. Deve ser maior ou igual a 0.';
        }

        if (count($erros) > 0) {
            throw new RepositorioException(implode(' | ', $erros));
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): self
    {
        $this->preco = $preco;
        return $this;
    }

    public function getTotalEstoque(): int
    {
        return $this->totalEstoque;
    }

    public function setTotalEstoque(int $totalEstoque): self
    {
        $this->totalEstoque = $totalEstoque;
        return $this;
    }
}

class Setor
{
    private int $id;
    private string $codigo;
    private string $nome;

    public function __construct(int $id, string $codigo, string $nome)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->validar();
    }

    public function validar(): void
    {
        $erros = [];

        if ($this->id <= 0) {
            $erros[] = 'ID inválido.';
        }

        if (mb_strlen(trim($this->codigo)) < 2 || mb_strlen(trim($this->codigo)) > 20) {
            $erros[] = 'Código do setor inválido.';
        }

        if (mb_strlen(trim($this->nome)) < 2 || mb_strlen(trim($this->nome)) > 100) {
            $erros[] = 'Nome do setor inválido.';
        }

        if (count($erros) > 0) {
            throw new RepositorioException(implode(' | ', $erros));
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;
        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }
}

class Estoque
{
    private int $id;
    private Produto $produto;
    private Setor $setor;
    private int $quantidade;

    public function __construct(int $id, Produto $produto, Setor $setor, int $quantidade)
    {
        $this->id = $id;
        $this->produto = $produto;
        $this->setor = $setor;
        $this->quantidade = $quantidade;
        $this->validar();
    }

    public function validar(): void
    {
        $erros = [];

        if ($this->id <= 0) {
            $erros[] = 'ID do estoque inválido.';
        }

        if (!is_numeric($this->quantidade) || $this->quantidade < 0) {
            $erros[] = 'Quantidade inválida. Deve ser maior ou igual a 0.';
        }

        if (count($erros) > 0) {
            throw new RepositorioException(implode(' | ', $erros));
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getProduto(): Produto
    {
        return $this->produto;
    }

    public function setProduto(Produto $produto): self
    {
        $this->produto = $produto;
        return $this;
    }

    public function getSetor(): Setor
    {
        return $this->setor;
    }

    public function setSetor(Setor $setor): self
    {
        $this->setor = $setor;
        return $this;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): self
    {
        $this->quantidade = $quantidade;
        return $this;
    }
}

interface RepositorioProdutos
{
    public function cadastrar(Produto $produto): bool;
    public function buscarPorId(int $id): ?Produto;
    public function listar(): array;
    public function atualizar(Produto $produto): bool;
    public function excluir(int $id): bool;
}

class RepositorioProdutosBDR implements RepositorioProdutos
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function cadastrar(Produto $produto): bool
    {
        $sql = 'INSERT INTO produto (descricao, preco, total_estoque) VALUES (:descricao, :preco, :total_estoque)';
        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([
            ':descricao' => $produto->getDescricao(),
            ':preco' => $produto->getPreco(),
            ':total_estoque' => $produto->getTotalEstoque(),
        ]);
    }

    public function buscarPorId(int $id): ?Produto
    {
        $sql = 'SELECT * FROM produto WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([':id' => $id]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        return new Produto(
            (int) $dados['id'],
            $dados['descricao'],
            (float) $dados['preco'],
            (int) $dados['total_estoque']
        );
    }

    public function listar(): array
    {
        $sql = 'SELECT * FROM produto ORDER BY id';
        $stmt = $this->conexao->query($sql);

        $produtos = [];

        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produtos[] = new Produto(
                (int) $linha['id'],
                $linha['descricao'],
                (float) $linha['preco'],
                (int) $linha['total_estoque']
            );
        }

        return $produtos;
    }

    public function atualizar(Produto $produto): bool
    {
        $sql = 'UPDATE produto SET descricao = :descricao, preco = :preco, total_estoque = :total_estoque WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([
            ':id' => $produto->getId(),
            ':descricao' => $produto->getDescricao(),
            ':preco' => $produto->getPreco(),
            ':total_estoque' => $produto->getTotalEstoque(),
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = 'DELETE FROM produto WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}

try {
    $setor = new Setor(1, 'ALM', 'Almoxarifado');
    $produto = new Produto(1, 'Arroz', 18.90, 40);
    $estoque = new Estoque(1, $produto, $setor, 15);

    echo 'Produto: ' . $produto->getDescricao() . PHP_EOL;
    echo 'Setor: ' . $setor->getNome() . PHP_EOL;
    echo 'Quantidade em estoque: ' . $estoque->getQuantidade() . PHP_EOL;
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}

/**
 * SQL recomendado para a tabela de estoque:
 *
 * CREATE TABLE produto (
 *     id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 *     descricao VARCHAR(100) NOT NULL UNIQUE,
 *     preco DECIMAL(10,2) NOT NULL,
 *     total_estoque INT NOT NULL DEFAULT 0
 * );
 *
 * CREATE TABLE setor (
 *     id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 *     codigo VARCHAR(20) NOT NULL UNIQUE,
 *     nome VARCHAR(100) NOT NULL
 * );
 *
 * CREATE TABLE estoque (
 *     id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 *     produto_id INT NOT NULL,
 *     setor_id INT NOT NULL,
 *     quantidade INT NOT NULL DEFAULT 0,
 *     CONSTRAINT fk_estoque_produto FOREIGN KEY (produto_id) REFERENCES produto(id),
 *     CONSTRAINT fk_estoque_setor FOREIGN KEY (setor_id) REFERENCES setor(id)
 * );
 */
