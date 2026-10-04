# Exercícios de Manipulação de CSV

Esta lista pratica leitura, validação, transformação e geração de arquivos CSV em PHP.

## Lista 1: Arquivos CSV

### 1. Leitura de CSV

Leia um arquivo `alunos.csv` contendo as colunas `nome`, `idade` e `curso`. Exiba cada registro de forma organizada.

* **Objetivo:** Usar `fopen`, `fgetcsv` e `fclose`, tratando o cabeçalho separadamente.

### 2. Conversão para Array Associativo

Transforme cada linha de um CSV em um array associativo usando a primeira linha como cabeçalho.

* **Objetivo:** Retornar uma estrutura equivalente a `[['nome' => 'Ana', 'idade' => '20', 'curso' => 'PHP']]`.

### 3. Validação de Registros

Leia um CSV de produtos e separe as linhas válidas das inválidas. Um registro válido deve possuir nome, preço numérico não negativo e quantidade inteira maior ou igual a zero.

* **Objetivo:** Gerar dois arrays e informar o número da linha e o motivo de cada rejeição.

### 4. Relatório de Vendas

Dado um CSV com as colunas `produto`, `categoria`, `quantidade` e `preco`, calcule o faturamento total por categoria.

* **Objetivo:** Multiplicar quantidade por preço, agrupar por categoria e ordenar o relatório do maior para o menor faturamento.

### 5. Filtragem e Exportação

Leia um CSV de clientes e gere um novo arquivo contendo apenas clientes ativos de uma cidade informada pelo usuário.

* **Objetivo:** Preservar o cabeçalho, escapar corretamente os campos e não carregar o arquivo inteiro na memória sem necessidade.

### 6. Importação Segura

Crie um importador de CSV que verifique tamanho máximo do arquivo, quantidade esperada de colunas e codificação dos dados antes de salvar os registros no sistema.

* **Objetivo:** Rejeitar arquivos inesperados, evitar fórmulas perigosas em células exportadas para planilhas e registrar um resumo da importação.
