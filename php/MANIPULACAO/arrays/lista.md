# Exercícios de Manipulação de Arrays

Esta lista é focada no treinamento de lógica de programação utilizando estruturas de dados em memória. As linguagens sugeridas para resolução são PHP, JavaScript, Python ou qualquer outra de sua preferência.

## Lista 1: Arrays Simples (Unidimensionais)

### 1. Transformação e Mapeamento
Dado um array contendo os preços originais de produtos, crie um novo array onde cada preço tenha um acréscimo de 15% de imposto.
* **Entrada de Exemplo:** `[50.00, 120.50, 30.00, 450.99]`
* **Objetivo:** Retornar o novo array com os valores atualizados.

### 2. Busca e Contagem de Elementos
Dado um array de strings representando as categorias de produtos vendidos em um dia, escreva um algoritmo que conte quantas vezes a categoria "Eletrônicos" aparece.
* **Entrada de Exemplo:** `["Roupas", "Eletrônicos", "Alimentos", "Eletrônicos", "Livros", "Eletrônicos"]`
* **Objetivo:** O resultado final deve ser o número inteiro `3`.

### 3. Ordenação e Remoção de Duplicatas
Você possui um array de números de identificação (IDs) que contém valores duplicados e está desordenado. Remova todas as duplicatas e ordene os IDs em ordem decrescente.
* **Entrada de Exemplo:** `[105, 102, 109, 102, 101, 105, 110]`
* **Objetivo:** Retornar o array limpo e ordenado: `[110, 109, 105, 102, 101]`.

### 4. Mapeamento de Domínio e Imagem (Matemática)

Dado um array representando o domínio de uma função matemática, escreva um script que aplique a função $f(x) = 2x^2 - 3x + 1$ a cada elemento e retorne um novo array contendo a imagem (os resultados calculados).

```php
$dominio = [-2, -1, 0, 1, 2, 3, 4];
```

### 5. Particionamento por Faixa

Dado um array de idades, separe os valores em dois arrays: um para menores de idade e outro para maiores ou iguais a 18 anos.

```php
$idades = [12, 18, 25, 16, 31, 14, 40];
```

* **Objetivo:** Retornar um array associativo com as chaves `menores` e `maiores`, mantendo a ordem original dos elementos.

### 6. Filtro de Entradas Suspeitas (Segurança)

Dado um array com strings de entrada de usuários, crie um script que identifique e separe em um novo array apenas as strings que contêm padrões suspeitos associados a vulnerabilidades como SQL Injection ou XSS. Considere como suspeitas as palavras-chave: `SELECT`, `<script>` e `OR 1=1`.

```php
$entradas = [
    "joao.silva@email.com",
    "<script>alert('xss')</script>",
    "senha_segura_123",
    "admin' OR 1=1 --",
    "1990-05-14"
];

```

### 7. Maior, Menor e Média

Dado um array de notas, crie uma função que retorne a maior nota, a menor nota e a média da turma.

```php
$notas = [7.5, 8.0, 6.5, 9.0, 5.5, 8.5];
```

* **Objetivo:** Retornar um array associativo com as chaves `maior`, `menor` e `media`.

### 8. Interseção de Arrays

Dado um array com os alunos matriculados em um curso e outro com os alunos presentes na aula, encontre quais alunos estavam matriculados e também presentes.

```php
$matriculados = ['Ana', 'Bruno', 'Carla', 'Diego', 'Elisa'];
$presentes = ['Carla', 'Diego', 'Fábio', 'Ana'];
```

* **Objetivo:** Retornar `['Ana', 'Carla', 'Diego']`, sem duplicidades e em ordem alfabética.

### 9. Frequência de Palavras

Dado um array de palavras, conte quantas vezes cada palavra aparece, ignorando diferenças entre letras maiúsculas e minúsculas.

```php
$palavras = ['PHP', 'array', 'php', 'String', 'ARRAY', 'php'];
```

* **Objetivo:** Retornar um array associativo equivalente a `['php' => 3, 'array' => 2, 'string' => 1]`.

### 10. Rotação de Elementos

Crie uma função que receba um array e um número inteiro positivo `k`, movendo os últimos `k` elementos para o início do array.

```php
$valores = [1, 2, 3, 4, 5, 6];
$k = 2;
```

* **Objetivo:** Retornar `[5, 6, 1, 2, 3, 4]`. Considere também os casos em que `k` é maior que o tamanho do array ou o array está vazio.

## Lista 2: Exercícios Abstratos e de Domínio

Nesta seção, use arrays para representar objetos, estados e regras de diferentes domínios. Procure separar os dados das funções que aplicam as regras.

### 11. Cadastro de Veículos

Represente carros, motos e caminhões em um array de veículos. Cada veículo deve possuir marca, modelo, ano, preço e situação (`disponivel` ou `vendido`).

* **Objetivo:** Criar funções para filtrar por situação, encontrar o veículo mais caro e calcular o valor total dos veículos disponíveis.

### 12. Corrida de Carros

Dado um array de pilotos e outro com os tempos obtidos em várias voltas, calcule o tempo total e a volta mais rápida de cada piloto.

```php
$voltas = [
    'Ana' => [72.4, 70.8, 71.6],
    'Bruno' => [69.9, 73.2, 70.5],
    'Carla' => [71.0, 70.2, 70.7]
];
```

* **Objetivo:** Criar um ranking pelo menor tempo total e informar o vencedor.

### 13. Abrigo de Animais

Modele animais de um abrigo com nome, espécie, idade, porte e situação de adoção. Crie operações para cadastrar, buscar por espécie e listar apenas animais disponíveis.

* **Objetivo:** Impedir nomes vazios, aceitar somente espécies cadastradas e contar quantos animais de cada espécie estão disponíveis.

### 14. Alimentação dos Animais

Dado um array de animais e suas necessidades diárias de ração, registre as porções fornecidas durante a semana.

* **Objetivo:** Calcular o total consumido por animal, apontar animais que receberam menos ração que o necessário e gerar um resumo por espécie.

### 15. Inventário de um Jogo

Represente o inventário de um personagem com itens, quantidades, peso e valor. O personagem possui um limite máximo de peso.

* **Objetivo:** Adicionar e remover itens, impedir que o peso máximo seja ultrapassado e calcular o valor total do inventário.

### 16. Campeonato de Jogos

Dado um array de equipes e suas partidas, atualize a tabela de classificação conforme o resultado de cada jogo. Vitória vale 3 pontos, empate vale 1 e derrota vale 0.

* **Objetivo:** Calcular pontos, vitórias, empates, derrotas e saldo de gols, ordenando a tabela pelos critérios definidos.

### 17. Tabuleiro de Xadrez

Represente um tabuleiro de xadrez como uma matriz `8 x 8`. Cada peça deve possuir cor, tipo e posição.

* **Objetivo:** Criar funções para posicionar e remover peças, verificar se uma casa está ocupada e listar todas as peças de uma determinada cor.

### 18. Validação de Movimento no Xadrez

Usando o tabuleiro do exercício anterior, valide movimentos de peão, torre, bispo, cavalo, dama e rei. Considere os limites do tabuleiro, o caminho livre das peças que atravessam casas e a captura de peças adversárias.

* **Objetivo:** Retornar um resultado estruturado indicando se o movimento é válido e o motivo da rejeição quando não for. Não é necessário implementar xeque, roque ou promoção nesta etapa.