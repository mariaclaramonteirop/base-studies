## Lista 2: Arrays de Arrays (Matrizes / Multidimensionais)

### 1. Processamento de Tabela de Vendas
Você tem uma matriz onde cada sub-array representa uma venda, contendo `[ID_Produto, Quantidade, Preco_Unitario]`. Calcule o valor total de cada venda e o faturamento global de todas as vendas somadas.
* **Entrada de Exemplo:**
  ```text
  [
    [101, 2, 45.00],
    [102, 1, 120.00],
    [103, 5, 10.50]
  ]
  ```
* **Objetivo:** Mostrar o total por linha (ex: `90.00`, `120.00`, `52.50`) e o total global ($262.50$).

### 2. Validador de Tabuleiro (Jogo da Velha)
Dada uma matriz $3 \times 3$ representando o estado atual de um jogo da velha (onde os valores podem ser `"X"`, `"O"` ou `""` para vazio), crie uma função que verifique se o jogador `"X"` ganhou na linha horizontal superior.
* **Entrada de Exemplo:**
  ```text
  [
    ["X", "X", "X"],
    ["O", "", "O"],
    ["", "O", ""]
  ]
  ```
* **Objetivo:** Retornar um valor booleano `Verdadeiro` ou `Falso`.

### 3. Reestruturação e Agrupamento
Você recebeu dados tabulares de clientes agrupados em um formato bruto. Transforme essa matriz em um dicionário (ou array associativo) onde a chave seja a `Cidade` e o valor seja um array contendo os `Nomes` dos clientes daquela cidade.
* **Entrada de Exemplo:**
  ```text
  [
    ["Nome" => "Ana", "Cidade" => "São Paulo"],
    ["Nome" => "João", "Cidade" => "Rio de Janeiro"],
    ["Nome" => "Bia", "Cidade" => "São Paulo"],
    ["Nome" => "Carlos", "Cidade" => "Belo Horizonte"]
  ]
  ```
* **Objetivo:**
  ```text
  [
    "São Paulo" => ["Ana", "Bia"],
    "Rio de Janeiro" => ["João"],
    "Belo Horizonte" => ["Carlos"]
  ]
  ```

### 4. Controle de Acesso ERP (RBAC)

A matriz abaixo define quais perfis de usuário (`roles`) têm acesso a quais módulos de um sistema ERP. Escreva uma função que receba essa matriz e um array com os perfis de um usuário específico, retornando uma lista única e indexada apenas com os nomes dos módulos que ele tem permissão para acessar.

```php
$permissoes_erp = [
    'Financeiro' => ['admin', 'gerente_fin'],
    'Estoque'    => ['admin', 'operador', 'gerente_log'],
    'Vendas'     => ['admin', 'vendedor', 'gerente_fin'],
    'RH'         => ['admin', 'rh_analista']
];

$perfis_usuario_atual = ['vendedor', 'operador']; 
// O resultado esperado é um array: ['Estoque', 'Vendas']

```

### 5. Avaliação de Benchmarks de IA

Você tem uma matriz com os resultados de diferentes modelos de linguagem de código aberto (LLMs) em três benchmarks de segurança e precisão. Crie um script que:

1. Calcule e exiba a média de pontuação de cada modelo.
2. Determine e imprima o nome do modelo que obteve a maior pontuação geral.

```php
$benchmarks_llm = [
    'Llama-3'   => ['prompt_injection' => 88, 'jailbreak' => 92, 'toxicity' => 85],
    'Mistral'   => ['prompt_injection' => 85, 'jailbreak' => 89, 'toxicity' => 82],
    'Gemma'     => ['prompt_injection' => 90, 'jailbreak' => 91, 'toxicity' => 88]
];

```

### 6. Detecção de Path Traversal

Esta matriz simula o histórico de requisições a um servidor web. Verifique os dados e adicione uma nova chave chamada `'alerta_seguranca'` com o valor booleano `true` em cada array interno onde a string do caminho (`path`) tentar voltar diretórios usando `../` (uma tentativa clássica de explorar a vulnerabilidade de Path Traversal).

```php
$requisicoes = [
    ['ip' => '192.168.0.10', 'path' => '/var/www/html/index.php'],
    ['ip' => '10.0.0.15',    'path' => '/var/www/html/assets/style.css'],
    ['ip' => '172.16.0.5',   'path' => '/var/www/html/../../../../etc/passwd'],
    ['ip' => '192.168.0.22', 'path' => '/var/www/html/downloads/arquivo.pdf'],
    ['ip' => '10.0.0.99',    'path' => '/var/www/html/uploads/../config.php']
];

```

### 7. Soma das Diagonais

Dada uma matriz quadrada de números inteiros, calcule a soma da diagonal principal e da diagonal secundária. Em matrizes de ordem ímpar, o elemento central deve ser contabilizado apenas uma vez no total geral.

```php
$matriz = [
  [4, 2, 7],
  [9, 5, 1],
  [6, 8, 3]
];
```

* **Objetivo:** Exibir a soma da diagonal principal (`12`), a soma da diagonal secundária (`18`) e a soma das duas sem duplicar o centro (`25`).

### 8. Transposição de uma Matriz

Crie uma função que receba uma matriz retangular e devolva sua transposta, transformando cada coluna em uma linha.

```php
$matriz = [
  [1, 2, 3],
  [4, 5, 6]
];
```

* **Objetivo:** Retornar `[[1, 4], [2, 5], [3, 6]]`.

### 9. Boletim por Aluno

Dado um array associativo com o nome de cada aluno e suas notas, calcule a média individual e classifique cada aluno como `aprovado` (média maior ou igual a 7) ou `reprovado`.

```php
$boletim = [
  'Ana' => [8, 7, 9],
  'Bruno' => [5, 6, 4],
  'Carla' => [7, 8, 7]
];
```

* **Objetivo:** Gerar um novo array contendo, para cada aluno, a média e a situação.

### 10. Inventário por Categoria

Dado um array de produtos, agrupe os itens por categoria e calcule o valor total em estoque de cada grupo (`quantidade * preco`).

```php
$produtos = [
  ['nome' => 'Teclado', 'categoria' => 'perifericos', 'quantidade' => 4, 'preco' => 120.00],
  ['nome' => 'Mouse', 'categoria' => 'perifericos', 'quantidade' => 6, 'preco' => 80.00],
  ['nome' => 'Monitor', 'categoria' => 'video', 'quantidade' => 2, 'preco' => 900.00]
];
```

* **Objetivo:** Retornar o total por categoria: `perifericos` com `R$ 960,00` e `video` com `R$ 1.800,00`.