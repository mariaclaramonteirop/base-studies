# Gabarito da P1

Esta pasta reúne uma resolução completa para a prova prática de PHP.

## Estrutura

- `gabarito.php`: solução com os principais modelos e repositório.

## Conteúdo principal

- Classe `Produto`
- Classe `Setor`
- Classe `Estoque`
- Exceção `RepositorioException`
- Interface `RepositorioProdutos`
- Implementação `RepositorioProdutosBDR`
- Script de exemplo com uso de CRUD.

## SQL base sugerido

```sql
CREATE TABLE produto (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL UNIQUE,
    preco DECIMAL(10,2) NOT NULL,
    total_estoque INT NOT NULL DEFAULT 0
);

CREATE TABLE setor (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE estoque (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    setor_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_estoque_produto FOREIGN KEY (produto_id) REFERENCES produto(id),
    CONSTRAINT fk_estoque_setor FOREIGN KEY (setor_id) REFERENCES setor(id)
);
```

## Observação

A lógica da validação foi pensada para evitar dados inválidos, como IDs menores ou iguais a zero, preço abaixo de R$ 0,50, descrição fora do intervalo permitido e quantidade negativa.
