# Exercícios de Manipulação de APIs

Esta lista pratica o consumo de APIs HTTP em PHP usando `cURL`, leitura de JSON, validação de respostas e tratamento de erros.

## Lista 1: Consumo de APIs

### 1. Consulta de Usuários

Consuma um endpoint público que retorne uma lista de usuários em JSON. Decodifique a resposta e exiba o nome, o e-mail e a cidade de cada usuário.

* **Objetivo:** Criar uma função reutilizável que receba a URL e retorne os dados decodificados como array associativo.

### 2. Busca por Identificador

Consuma um endpoint de detalhes de usuário que receba um ID na URL. Mostre os dados do usuário quando a resposta for bem-sucedida.

* **Objetivo:** Validar o ID antes da requisição e informar uma mensagem adequada quando a API retornar status `404`.

### 3. Tratamento de Erros HTTP

Crie uma função para fazer requisições `GET` e tratar separadamente erros de conexão, respostas inválidas e códigos HTTP de erro (`400`, `401`, `404` e `500`).

* **Objetivo:** A função deve retornar os dados em caso de sucesso e lançar ou retornar uma mensagem de erro estruturada nos demais casos.

### 4. Envio de Dados com POST

Envie um novo produto para uma API usando uma requisição `POST` com corpo JSON.

```php
$produto = [
	'nome' => 'Teclado mecânico',
	'preco' => 249.90,
	'estoque' => 15
];
```

* **Objetivo:** Configurar o método, o cabeçalho `Content-Type: application/json`, o corpo da requisição e validar a resposta criada.

### 5. Paginação de Resultados

Consuma uma API que disponibilize resultados paginados. Faça requisições sucessivas até obter todos os registros ou até atingir uma quantidade máxima de páginas.

* **Objetivo:** Juntar os resultados em um único array, evitando registros duplicados e interrompendo o processo quando não houver mais dados.

### 6. Cache de Resposta

Crie uma função que consulte uma API e armazene a resposta JSON em um arquivo de cache. Enquanto o cache tiver menos de cinco minutos, use o arquivo sem fazer uma nova requisição.

* **Objetivo:** Controlar a validade pelo horário de modificação do arquivo e atualizar o cache somente quando necessário.
