# Exercícios de Manipulação de APIs

Esta lista pratica o consumo de APIs HTTP em PHP usando `cURL`, leitura de JSON, validação de respostas e tratamento de erros.

## Lista 1: Consumo de APIs

### 1. Consulta de Usuários

Consuma um endpoint público que retorne uma lista de usuários em JSON. Decodifique a resposta e exiba o nome, o e-mail e a cidade de cada usuário.

* **Objetivo:** Criar uma função reutilizável que receba a URL e retorne os dados decodificados como array associativo.

**Versão prática:** Implemente `GET /api/usuarios` usando as entidades `Usuario` e `Endereco`. Retorne nome, e-mail e cidade em JSON, usando `JOIN` entre as tabelas. Valide paginação, limite máximo de registros e e-mail válido; não exponha senha ou campos internos.

### 2. Busca por Identificador

Consuma um endpoint de detalhes de usuário que receba um ID na URL. Mostre os dados do usuário quando a resposta for bem-sucedida.

* **Objetivo:** Validar o ID antes da requisição e informar uma mensagem adequada quando a API retornar status `404`.

**Versão prática:** Implemente `GET /api/usuarios/{id}` para retornar `Usuario`, `Perfil` e telefones relacionados. Valide ID inteiro positivo, diferencie `400`, `404` e `500`, e retorne `404` quando o usuário ou seu perfil não existir.

### 3. Tratamento de Erros HTTP

Crie uma função para fazer requisições `GET` e tratar separadamente erros de conexão, respostas inválidas e códigos HTTP de erro (`400`, `401`, `404` e `500`).

* **Objetivo:** A função deve retornar os dados em caso de sucesso e lançar ou retornar uma mensagem de erro estruturada nos demais casos.

**Versão prática:** Crie `ApiCliente`, `RequisicaoApi`, `ErroApi` e `RepositorioLogApi`. Registre URL, método, status, mensagem e horário de cada falha, relacionando o log ao serviço consumido. Nunca retorne stack trace, senha ou token ao cliente.

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

**Versão prática:** Implemente `POST /api/produtos` com as entidades `Produto`, `Categoria` e `Fornecedor`. Receba JSON, valide nome entre 2 e 100 caracteres, preço maior que zero, estoque inteiro não negativo e IDs relacionados existentes. Use transação e retorne `201` com o produto criado.

### 5. Paginação de Resultados

Consuma uma API que disponibilize resultados paginados. Faça requisições sucessivas até obter todos os registros ou até atingir uma quantidade máxima de páginas.

* **Objetivo:** Juntar os resultados em um único array, evitando registros duplicados e interrompendo o processo quando não houver mais dados.

**Versão prática:** Implemente `GET /api/pedidos?page=1&limite=20`, retornando pedidos, cliente e itens do pedido. Use `JOIN`, limite o tamanho da página, valide os parâmetros e devolva metadados `pagina`, `limite`, `total` e `ultima_pagina`.

### 6. Cache de Resposta

Crie uma função que consulte uma API e armazene a resposta JSON em um arquivo de cache. Enquanto o cache tiver menos de cinco minutos, use o arquivo sem fazer uma nova requisição.

* **Objetivo:** Controlar a validade pelo horário de modificação do arquivo e atualizar o cache somente quando necessário.

**Versão prática:** Faça cache do catálogo formado pelas entidades `Produto` e `Categoria`. Armazene a resposta e a data de expiração, invalide o cache quando um produto for alterado e impeça que duas requisições simultâneas gravem conteúdo incompleto.

### 7. Atualização Completa com PUT

Consuma um endpoint de produtos e atualize todos os dados de um produto usando o método `PUT` e um corpo JSON.

```php
$produtoAtualizado = [
	'nome' => 'Teclado mecânico RGB',
	'preco' => 299.90,
	'estoque' => 20,
	'categoria' => 'perifericos'
];
```

* **Objetivo:** Enviar a requisição para `/produtos/{id}`, configurar os cabeçalhos corretos e tratar os status `200` e `404`.

**Versão prática:** Implemente `PUT /api/produtos/{id}` atualizando produto, categoria e fornecedor em uma transação. Valide todos os campos obrigatórios mesmo quando apenas um valor parece ter mudado, confirme as três entidades relacionadas e rejeite alteração de ID.

### 8. Atualização Parcial com PATCH

Atualize somente o preço e o estoque de um produto sem enviar os demais campos. Use o método `PATCH`.

* **Objetivo:** Diferenciar `PUT` de `PATCH`, enviando apenas os campos alterados e verificando se a API retornou o recurso atualizado.

**Versão prática:** Implemente `PATCH /api/animais/{id}` para alterar parcialmente nome, situação de adoção ou responsável. Use as entidades `Animal`, `Especie` e `Adotante`; aceite somente campos permitidos, valide os valores enviados e registre os campos modificados em uma tabela de auditoria.

### 9. Exclusão com DELETE

Crie uma função que remova um usuário por ID usando o método `DELETE`.

* **Objetivo:** Tratar respostas `204 No Content`, `404 Not Found` e `401 Unauthorized` sem tentar decodificar JSON quando o corpo estiver vazio.

### 10. API que Retorna HTML

Consuma um endpoint que retorne uma página ou fragmento HTML. Salve a resposta em um arquivo `.html` e extraia os títulos dos elementos `<h1>` e `<h2>`.

* **Objetivo:** Enviar o cabeçalho `Accept: text/html`, verificar o `Content-Type` recebido e usar `DOMDocument` ou `DOMXPath` para analisar o HTML.

### 11. Negociação de Formato

Faça duas requisições para o mesmo recurso, solicitando respostas diferentes com o cabeçalho `Accept`: `application/json` e `text/html`.

* **Objetivo:** Comparar os conteúdos recebidos, identificar o formato pelo cabeçalho `Content-Type` e tratar uma resposta `406 Not Acceptable`.

### 12. API que Retorna XML

Consuma um endpoint que retorne XML com uma lista de livros. Converta os dados para um array PHP e gere uma saída JSON equivalente.

* **Objetivo:** Validar XML malformado e preservar os campos `id`, `titulo`, `autor` e `preco`.

### 13. Autenticação com Bearer Token

Consuma um endpoint protegido que exige o cabeçalho `Authorization: Bearer TOKEN`.

* **Objetivo:** Enviar o token por configuração segura, nunca gravá-lo diretamente no código, e diferenciar respostas `200`, `401` e `403`.

### 14. Login e Uso de Token

Envie e-mail e senha para um endpoint de login usando `POST`. Leia o token retornado em JSON e use-o para consultar o perfil do usuário.

```php
$credenciais = [
	'email' => 'ana@example.com',
	'senha' => 'senha-de-exemplo'
];
```

* **Objetivo:** Não exibir a senha em logs, validar a existência do token e invalidá-lo quando a API retornar `401`.

### 15. API com Formulário Multipart

Envie uma imagem de perfil para uma API usando `POST` com `multipart/form-data`.

* **Objetivo:** Usar `CURLFile`, validar tamanho e tipo MIME antes do envio e interpretar a URL do arquivo retornada pela API.

### 16. Webhook Recebido

Crie um endpoint PHP que receba um webhook no corpo da requisição, leia `php://input` e processe eventos como `pedido.criado` e `pagamento.aprovado`.

* **Objetivo:** Validar a assinatura enviada em um cabeçalho, rejeitar JSON inválido e responder com os status HTTP adequados.

### 17. Rate Limit e Retry

Consuma uma API que pode retornar `429 Too Many Requests` e o cabeçalho `Retry-After`.

* **Objetivo:** Repetir a requisição somente quando permitido, limitar o número de tentativas e interromper imediatamente em erros que não sejam temporários.

### 18. Exportação do Resultado da API

Consuma uma API de pedidos em JSON, normalize os dados e gere dois arquivos: um relatório CSV e uma página HTML com uma tabela.

* **Objetivo:** Reutilizar os mesmos dados para formatos diferentes, escapar valores no HTML e informar falhas parciais de exportação.

## SQL dos Exercícios 1 a 18

Os esquemas abaixo são sugestões independentes para praticar persistência junto com cada exercício. Quando o exercício consumir uma API externa, as tabelas podem representar uma cópia local ou os dados recebidos antes do processamento.

### Exercício 1: Usuários

```sql
CREATE TABLE api_usuario_01 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	cidade VARCHAR(80) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE api_endereco_01 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	usuario_id INT NOT NULL,
	logradouro VARCHAR(150) NOT NULL,
	cidade VARCHAR(80) NOT NULL,
	FOREIGN KEY (usuario_id) REFERENCES api_usuario_01(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```

### Exercício 2: Usuário por Identificador

```sql
CREATE TABLE api_usuario_02 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE api_perfil_02 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	usuario_id INT NOT NULL,
	endereco VARCHAR(150),
	FOREIGN KEY (usuario_id) REFERENCES api_usuario_02(id)
) ENGINE=InnoDB;

CREATE TABLE api_telefone_02 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	usuario_id INT NOT NULL,
	numero VARCHAR(20) NOT NULL,
	FOREIGN KEY (usuario_id) REFERENCES api_usuario_02(id) ON DELETE CASCADE,
	UNIQUE (usuario_id, numero)
) ENGINE=InnoDB;
```

### Exercício 3: Registro de Requisições

```sql
CREATE TABLE api_servico_03 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(80) NOT NULL UNIQUE,
	base_url VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE api_requisicao_03 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	servico_id INT NOT NULL,
	url VARCHAR(255) NOT NULL,
	metodo VARCHAR(10) NOT NULL,
	status_http SMALLINT NOT NULL,
	erro VARCHAR(255),
	realizada_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (servico_id) REFERENCES api_servico_03(id)
) ENGINE=InnoDB;
```

### Exercício 4: Produtos Criados

```sql
CREATE TABLE api_categoria_04 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE api_fornecedor_04 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE api_produto_04 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	categoria_id INT NOT NULL,
	fornecedor_id INT NOT NULL,
	nome VARCHAR(100) NOT NULL,
	preco DECIMAL(10,2) NOT NULL,
	estoque INT NOT NULL DEFAULT 0,
	criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (categoria_id) REFERENCES api_categoria_04(id),
	FOREIGN KEY (fornecedor_id) REFERENCES api_fornecedor_04(id),
	CHECK (preco >= 0),
	CHECK (estoque >= 0)
) ENGINE=InnoDB;
```

### Exercício 5: Páginas de Resultados

```sql
CREATE TABLE api_cliente_05 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE api_produto_05 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	preco DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE api_pedido_05 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	cliente_id INT NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (cliente_id) REFERENCES api_cliente_05(id)
) ENGINE=InnoDB;

CREATE TABLE api_item_pedido_05 (
	pedido_id INT NOT NULL,
	produto_id INT NOT NULL,
	quantidade INT NOT NULL,
	PRIMARY KEY (pedido_id, produto_id),
	FOREIGN KEY (pedido_id) REFERENCES api_pedido_05(id) ON DELETE CASCADE,
	FOREIGN KEY (produto_id) REFERENCES api_produto_05(id),
	CHECK (quantidade > 0)
) ENGINE=InnoDB;
```

### Exercício 6: Cache

```sql
CREATE TABLE api_categoria_06 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE api_produto_06 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	categoria_id INT NOT NULL,
	nome VARCHAR(100) NOT NULL,
	preco DECIMAL(10,2) NOT NULL,
	FOREIGN KEY (categoria_id) REFERENCES api_categoria_06(id)
) ENGINE=InnoDB;

CREATE TABLE api_cache_06 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	recurso VARCHAR(150) NOT NULL UNIQUE,
	resposta_json JSON NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	expira_em DATETIME NOT NULL
) ENGINE=InnoDB;
```

### Exercício 7: Atualização de Produtos

```sql
CREATE TABLE api_categoria_07 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE api_fornecedor_07 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE api_produto_07 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	categoria_id INT NOT NULL,
	fornecedor_id INT NOT NULL,
	nome VARCHAR(100) NOT NULL,
	preco DECIMAL(10,2) NOT NULL,
	estoque INT NOT NULL,
	atualizado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (categoria_id) REFERENCES api_categoria_07(id),
	FOREIGN KEY (fornecedor_id) REFERENCES api_fornecedor_07(id),
	CHECK (preco >= 0),
	CHECK (estoque >= 0)
) ENGINE=InnoDB;
```

### Exercício 8: Alteração Parcial

```sql
CREATE TABLE api_especie_08 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE api_adotante_08 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	telefone VARCHAR(20)
) ENGINE=InnoDB;

CREATE TABLE api_animal_08 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	especie_id INT NOT NULL,
	adotante_id INT,
	nome VARCHAR(80) NOT NULL,
	situacao VARCHAR(20) NOT NULL,
	FOREIGN KEY (especie_id) REFERENCES api_especie_08(id),
	FOREIGN KEY (adotante_id) REFERENCES api_adotante_08(id),
	CHECK (situacao IN ('disponivel', 'adotado'))
) ENGINE=InnoDB;

CREATE TABLE api_alteracao_08 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	animal_id INT NOT NULL,
	campo VARCHAR(40) NOT NULL,
	valor_anterior VARCHAR(255),
	valor_novo VARCHAR(255) NOT NULL,
	alterado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (animal_id) REFERENCES api_animal_08(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```

### Exercício 9: Exclusões

```sql
CREATE TABLE api_exclusao_09 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	recurso VARCHAR(80) NOT NULL,
	recurso_id INT NOT NULL,
	motivo VARCHAR(255),
	excluido_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

### Exercício 10: Documentos HTML

```sql
CREATE TABLE api_documento_10 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	url VARCHAR(255) NOT NULL UNIQUE,
	titulo VARCHAR(200),
	conteudo_html LONGTEXT NOT NULL,
	recebido_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

### Exercício 11: Formatos de Resposta

```sql
CREATE TABLE api_formato_11 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	recurso VARCHAR(100) NOT NULL,
	formato VARCHAR(40) NOT NULL,
	content_type VARCHAR(100) NOT NULL,
	resposta LONGTEXT NOT NULL,
	UNIQUE (recurso, formato)
) ENGINE=InnoDB;
```

### Exercício 12: Livros XML

```sql
CREATE TABLE api_livro_12 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(150) NOT NULL,
	autor VARCHAR(100) NOT NULL,
	preco DECIMAL(10,2) NOT NULL,
	CHECK (preco >= 0)
) ENGINE=InnoDB;
```

### Exercício 13: Tokens de Acesso

```sql
CREATE TABLE api_token_13 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	identificador VARCHAR(80) NOT NULL,
	token_hash CHAR(64) NOT NULL UNIQUE,
	escopo VARCHAR(100) NOT NULL,
	expira_em DATETIME NOT NULL
) ENGINE=InnoDB;
```

### Exercício 14: Login

```sql
CREATE TABLE api_conta_14 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(100) NOT NULL UNIQUE,
	hash_senha CHAR(64) NOT NULL,
	ativo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE api_token_14 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	conta_id INT NOT NULL,
	token_hash CHAR(64) NOT NULL UNIQUE,
	expira_em DATETIME NOT NULL,
	FOREIGN KEY (conta_id) REFERENCES api_conta_14(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```

### Exercício 15: Uploads

```sql
CREATE TABLE api_upload_15 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome_original VARCHAR(255) NOT NULL,
	nome_armazenado VARCHAR(255) NOT NULL UNIQUE,
	mime_type VARCHAR(100) NOT NULL,
	tamanho_bytes INT NOT NULL,
	enviado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CHECK (tamanho_bytes > 0)
) ENGINE=InnoDB;
```

### Exercício 16: Webhooks

```sql
CREATE TABLE api_evento_16 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	tipo VARCHAR(80) NOT NULL,
	id_externo VARCHAR(100) NOT NULL,
	payload_json JSON NOT NULL,
	processado TINYINT(1) NOT NULL DEFAULT 0,
	recebido_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	UNIQUE (tipo, id_externo)
) ENGINE=InnoDB;
```

### Exercício 17: Controle de Rate Limit

```sql
CREATE TABLE api_limite_17 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	identificador VARCHAR(100) NOT NULL,
	janela_inicio DATETIME NOT NULL,
	quantidade_requisicoes INT NOT NULL DEFAULT 0,
	UNIQUE (identificador, janela_inicio),
	CHECK (quantidade_requisicoes >= 0)
) ENGINE=InnoDB;
```

### Exercício 18: Exportação de Pedidos

```sql
CREATE TABLE api_pedido_18 (
	id INT AUTO_INCREMENT PRIMARY KEY,
	cliente VARCHAR(100) NOT NULL,
	status VARCHAR(30) NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE api_item_pedido_18 (
	pedido_id INT NOT NULL,
	produto VARCHAR(100) NOT NULL,
	quantidade INT NOT NULL,
	preco DECIMAL(10,2) NOT NULL,
	PRIMARY KEY (pedido_id, produto),
	FOREIGN KEY (pedido_id) REFERENCES api_pedido_18(id) ON DELETE CASCADE,
	CHECK (quantidade > 0),
	CHECK (preco >= 0)
) ENGINE=InnoDB;
```

## Lista 2: Exercícios no Estilo de Prova

Os exercícios desta seção simulam questões de avaliação. Resolva-os usando PHP sem bibliotecas externas, UTF-8, PDO, MVC e o padrão Repository. Considere que cada aplicação possui um único ponto de entrada, deve usar códigos HTTP adequados e precisa proteger entradas contra SQL Injection e XSS.

### Estrutura obrigatória para os exercícios 19 a 24

Em cada exercício, organize o projeto com responsabilidades separadas:

* **Entidades:** classes simples que representam os dados do domínio, sem acessar `$_GET`, `$_POST`, `$_SERVER`, banco de dados ou cookies.
* **Repositórios:** interfaces e implementações com PDO. Os métodos devem receber e retornar entidades ou arrays de entidades, nunca arrays genéricos de banco.
* **Controladoras:** recebem dados já interpretados pela Visão, chamam os serviços ou repositórios e devolvem resultados. Não devem conhecer URLs, mensagens de saída ou variáveis globais.
* **Visões:** interpretam método, URL, cabeçalhos e corpo da requisição; também produzem status, cabeçalhos e respostas JSON ou HTML.
* **Serviços:** concentram regras de negócio e validações que não pertencem à Entidade ou ao Repositório.

Para todos os exercícios, valide presença, tipo, formato, tamanho e limites dos dados; acumule os erros de entrada antes de responder; use consultas preparadas; escape valores ao gerar HTML; e trate `404`, `405`, `409`, `422` e `500` quando forem aplicáveis. As consultas que retornarem dados relacionados devem usar `JOIN` explícito, selecionar somente as colunas necessárias e transformar o resultado em entidades ou objetos de relatório.

### 19. API de Fornecedores com CRUD

Considere as tabelas `fornecedor`, `categoria_fornecedor` e `fornecedor_categoria`. Um fornecedor possui `id`, `codigo`, `nome`, `cnpj`, `email` e `telefone` e pode pertencer a várias categorias. Implemente uma API RESTful com o recurso `/fornecedores`:

* `GET /fornecedores?filtro=...&categoria=...`: retorna em JSON os fornecedores e suas categorias, usando `JOIN` entre as três tabelas. O filtro pode procurar no fornecedor ou no nome da categoria.
* `POST /fornecedores`: cadastra um fornecedor recebendo dados em `application/x-www-form-urlencoded`.
* `PUT /fornecedores/{id}`: atualiza um fornecedor recebendo JSON.
* `DELETE /fornecedores/{id-ou-codigo}`: remove pelo ID ou pelo código.

Regras: `codigo` deve seguir o padrão `AA-99.aa`, `cnpj` e `telefone` devem conter somente números, as categorias informadas devem existir e os campos obrigatórios devem respeitar os limites do banco. Todos os problemas de validação devem ser retornados de uma só vez.

* **Objetivo:** Criar as classes de domínio, a interface `RepositorioFornecedor`, a implementação com PDO, a controladora e as visões responsáveis por entrada e saída.

**Classes e validações:** Crie `Fornecedor`, `CategoriaFornecedor`, `FornecedorCategoria`, `RepositorioFornecedor`, `RepositorioCategoria`, `RepositorioFornecedorEmBDR`, `ValidadorFornecedor`, `FornecedorControladora` e uma visão para JSON. Valide `codigo` com `^[A-Z]{2}-[0-9]{2}\.[a-z]{2}$`, `nome` entre 2 e 100 caracteres, `cnpj` com 14 dígitos, `email` com formato válido e até 60 caracteres e `telefone` com 10 ou 11 dígitos. Verifique unicidade, categorias repetidas e chaves estrangeiras; use `409 Conflict` para duplicidades.

**SQL inicial:**

```sql
CREATE TABLE fornecedor (
	id INT AUTO_INCREMENT PRIMARY KEY,
	codigo CHAR(8) NOT NULL UNIQUE,
	nome VARCHAR(100) NOT NULL,
	cnpj CHAR(14) NOT NULL UNIQUE,
	email VARCHAR(60) NOT NULL UNIQUE,
	telefone VARCHAR(11) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE categoria_fornecedor (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(40) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE fornecedor_categoria (
	fornecedor_id INT NOT NULL,
	categoria_id INT NOT NULL,
	PRIMARY KEY (fornecedor_id, categoria_id),
	FOREIGN KEY (fornecedor_id) REFERENCES fornecedor(id),
	FOREIGN KEY (categoria_id) REFERENCES categoria_fornecedor(id)
) ENGINE=InnoDB;
```

### 20. Autorização por Bearer Token e Resposta HTML

Considere as tabelas `usuario`, `telefone`, `papel` e `usuario_papel`, além de uma API que recebe o cabeçalho `Authorization: Bearer TOKEN`. Implemente `GET /api/telefones`, que retorne uma página HTML com nome, login, nome do papel e telefone dos usuários autorizados. O parâmetro `ordem` deve aceitar somente `nome` ou `telefone`, usando `nome` como padrão.

O token deve ser validado por um serviço de autorização ou por uma tabela própria de tokens. A consulta deve usar `JOIN` entre usuários, telefones e papéis. Usuários comuns podem consultar os próprios dados; administradores podem consultar todos os telefones.

* **Objetivo:** Separar autenticação, autorização, consulta no repositório e geração da visão HTML, retornando `401` para token ausente ou inválido e `403` para permissão insuficiente.

**Classes e validações:** Crie `Usuario`, `Telefone`, `Papel`, `TokenAcesso`, `RepositorioUsuario`, `RepositorioTelefone`, `RepositorioPapel`, `AutorizacaoServico`, `TelefonesControladora` e uma visão HTML. Valide o formato e o tamanho do token, confirme sua validade e permissão, aceite `ordem` somente com os valores `nome` e `telefone`, elimine duplicidades no resultado e confirme que o usuário relacionado existe antes de exibir seus telefones.

**SQL inicial:**

```sql
CREATE TABLE usuario (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	login VARCHAR(50) NOT NULL UNIQUE,
	ativo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE telefone (
	id INT AUTO_INCREMENT PRIMARY KEY,
	usuario_id INT NOT NULL,
	numero VARCHAR(11) NOT NULL,
	FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE,
	UNIQUE (usuario_id, numero)
) ENGINE=InnoDB;

CREATE TABLE papel (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(30) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE usuario_papel (
	usuario_id INT NOT NULL,
	papel_id INT NOT NULL,
	PRIMARY KEY (usuario_id, papel_id),
	FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE,
	FOREIGN KEY (papel_id) REFERENCES papel(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE token_acesso (
	id INT AUTO_INCREMENT PRIMARY KEY,
	usuario_id INT NOT NULL,
	token_hash CHAR(64) NOT NULL UNIQUE,
	expira_em DATETIME NOT NULL,
	FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```

### 21. Criação de Pedido com Transação

Considere as tabelas `cliente`, `pedido`, `item_pedido`, `produto` e `estoque`, sendo que cada produto possui preço e estoque disponível. Implemente `POST /api/pedidos`, recebendo JSON com o cliente e uma lista de itens:

```json
{
	"cliente_id": 12,
	"itens": [
		{"produto_id": 4, "quantidade": 2},
		{"produto_id": 9, "quantidade": 1}
	]
}
```

Valide o JSON, a existência do cliente e dos produtos, quantidades positivas e estoque suficiente. Busque preço e saldo com `JOIN` entre produto e estoque, e calcule o total no servidor, sem confiar em preços enviados pelo cliente.

* **Objetivo:** Criar pedido e itens em uma única transação, bloquear ou conferir corretamente o estoque e desfazer todas as alterações caso qualquer etapa falhe.

**Classes e validações:** Crie `Cliente`, `Produto`, `Estoque`, `Pedido`, `ItemPedido`, `RepositorioCliente`, `RepositorioProduto`, `RepositorioEstoque`, `RepositorioPedido`, `PedidoServico` e `PedidoControladora`. Valide JSON bem-formado, `cliente_id` inteiro positivo, cliente ativo, lista de itens não vazia, `produto_id` inteiro positivo, quantidade inteira maior que zero, produtos existentes, estoque suficiente e ausência de itens repetidos no mesmo pedido. O total deve ser calculado usando o preço persistido do produto.

**SQL inicial:**

```sql
CREATE TABLE cliente (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	ativo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE produto (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	preco DECIMAL(10,2) NOT NULL,
	ativo TINYINT(1) NOT NULL DEFAULT 1,
	CHECK (preco >= 0)
) ENGINE=InnoDB;

CREATE TABLE estoque (
	produto_id INT PRIMARY KEY,
	quantidade INT NOT NULL DEFAULT 0,
	FOREIGN KEY (produto_id) REFERENCES produto(id),
	CHECK (quantidade >= 0)
) ENGINE=InnoDB;

CREATE TABLE pedido (
	id INT AUTO_INCREMENT PRIMARY KEY,
	cliente_id INT NOT NULL,
	criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	total DECIMAL(10,2) NOT NULL DEFAULT 0,
	FOREIGN KEY (cliente_id) REFERENCES cliente(id)
) ENGINE=InnoDB;

CREATE TABLE item_pedido (
	pedido_id INT NOT NULL,
	produto_id INT NOT NULL,
	quantidade INT NOT NULL,
	preco_unitario DECIMAL(10,2) NOT NULL,
	PRIMARY KEY (pedido_id, produto_id),
	FOREIGN KEY (pedido_id) REFERENCES pedido(id) ON DELETE CASCADE,
	FOREIGN KEY (produto_id) REFERENCES produto(id),
	CHECK (quantidade > 0)
) ENGINE=InnoDB;
```

### 22. Cadastro de Produto e Estoque por Setor

Modele uma API para produtos, fornecedores, setores e estoque. Um produto possui descrição, preço e fornecedor; um setor possui código e nome; o estoque relaciona produto, setor e quantidade.

Implemente `POST /api/produtos`, recebendo os dados do produto, fornecedor e sua quantidade inicial. Valide descrição entre 2 e 100 caracteres, preço maior ou igual a `0.50`, quantidade inteira não negativa, código de setor com três caracteres e existência do fornecedor e do setor.

* **Objetivo:** Usar transação para cadastrar o produto e o estoque, impedir registros duplicados para o mesmo produto e setor e retornar todos os erros de validação em uma resposta única.

**Classes e validações:** Crie `Produto`, `Fornecedor`, `Setor`, `Estoque`, `RepositorioProduto`, `RepositorioFornecedor`, `RepositorioSetor`, `RepositorioEstoque`, `ProdutoServico` e `ProdutoControladora`. Use `JOIN` para listar produto, fornecedor, setor e quantidade. Valide descrição entre 2 e 100 caracteres, preço numérico maior ou igual a `0.50`, quantidade inteira maior ou igual a zero, código do setor com exatamente três caracteres e entidades relacionadas existentes. Rejeite campos desconhecidos, valores negativos e a combinação produto-setor já cadastrada com `409 Conflict`.

**SQL inicial:**

```sql
CREATE TABLE fornecedor_produto (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE setor (
	id INT AUTO_INCREMENT PRIMARY KEY,
	codigo CHAR(3) NOT NULL UNIQUE,
	nome VARCHAR(60) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE produto_setor (
	id INT AUTO_INCREMENT PRIMARY KEY,
	fornecedor_id INT NOT NULL,
	descricao VARCHAR(100) NOT NULL,
	preco DECIMAL(10,2) NOT NULL,
	FOREIGN KEY (fornecedor_id) REFERENCES fornecedor_produto(id),
	CHECK (preco >= 0.50)
) ENGINE=InnoDB;

CREATE TABLE estoque_setor (
	produto_id INT NOT NULL,
	setor_id INT NOT NULL,
	quantidade INT NOT NULL DEFAULT 0,
	PRIMARY KEY (produto_id, setor_id),
	FOREIGN KEY (produto_id) REFERENCES produto_setor(id) ON DELETE CASCADE,
	FOREIGN KEY (setor_id) REFERENCES setor(id),
	CHECK (quantidade >= 0)
) ENGINE=InnoDB;
```

### 23. Preflight CORS e Rotas Não Permitidas

Considere as tabelas `rota`, `metodo` e `permissao_origem`. Para os recursos dos exercícios anteriores, implemente o tratamento de requisições `OPTIONS`. A origem autorizada deve ser consultada nessas tabelas, e cada rota deve informar seus métodos permitidos em `Access-Control-Allow-Methods`.

* **Objetivo:** Responder ao preflight com `200`, rejeitar origens não autorizadas, retornar `404` para rotas inexistentes e `405` para métodos não permitidos, incluindo o cabeçalho `Allow`.

**Classes e validações:** Crie `Rota`, `MetodoHttp`, `PermissaoOrigem`, `Roteador`, `RepositorioRota`, `RepositorioPermissaoOrigem`, `CorsServico` e uma visão de erros HTTP. Use `JOIN` para descobrir os métodos permitidos de cada rota. Normalize método e caminho, rejeite caminhos vazios ou malformados, valide a origem, aceite somente métodos cadastrados e nunca use `Access-Control-Allow-Origin: *` quando houver credenciais.

**SQL inicial:**

```sql
CREATE TABLE rota (
	id INT AUTO_INCREMENT PRIMARY KEY,
	caminho VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE metodo_http (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(10) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE rota_metodo (
	rota_id INT NOT NULL,
	metodo_id INT NOT NULL,
	PRIMARY KEY (rota_id, metodo_id),
	FOREIGN KEY (rota_id) REFERENCES rota(id) ON DELETE CASCADE,
	FOREIGN KEY (metodo_id) REFERENCES metodo_http(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE permissao_origem (
	id INT AUTO_INCREMENT PRIMARY KEY,
	rota_id INT NOT NULL,
	origem VARCHAR(255) NOT NULL,
	FOREIGN KEY (rota_id) REFERENCES rota(id) ON DELETE CASCADE,
	UNIQUE (rota_id, origem)
) ENGINE=InnoDB;
```

### 24. Questão Integrada de Relatório

Considere as tabelas `venda`, `item_venda`, `produto`, `usuario` e `categoria`. Crie `GET /api/relatorio-vendas`, acessível apenas a administradores, que consulte essas tabelas e ofereça dois formatos conforme o cabeçalho `Accept`:

* `application/json`: retorna totais agrupados por usuário e categoria.
* `text/html`: retorna uma tabela HTML com usuário, categoria, quantidade e total.

O endpoint deve aceitar os parâmetros opcionais `inicio`, `fim` e `categoria`, validar datas, fazer `JOIN` entre as cinco tabelas, usar consulta preparada e ordenar os resultados pelo maior total.

* **Objetivo:** Demonstrar negociação de conteúdo, autorização, filtros, agregação SQL, objetos de domínio, escape de HTML e respostas HTTP consistentes.

**Classes e validações:** Crie `Venda`, `ItemVenda`, `Produto`, `Usuario`, `Categoria`, `RelatorioVenda`, `RepositorioVenda`, `RepositorioProduto`, `RepositorioUsuario`, `RelatorioServico` e `RelatorioControladora`, com visões separadas para JSON e HTML. Valide datas no formato `YYYY-MM-DD`, exija que a data inicial não seja posterior à final, confirme que a categoria existe, limite o intervalo consultado, evite duplicar vendas no agrupamento, rejeite formatos não suportados com `406 Not Acceptable` e escape nome, e-mail e demais valores na tabela HTML.

**SQL inicial:**

```sql
CREATE TABLE usuario_relatorio (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE categoria (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(60) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE produto_relatorio (
	id INT AUTO_INCREMENT PRIMARY KEY,
	categoria_id INT NOT NULL,
	nome VARCHAR(100) NOT NULL,
	FOREIGN KEY (categoria_id) REFERENCES categoria(id)
) ENGINE=InnoDB;

CREATE TABLE venda (
	id INT AUTO_INCREMENT PRIMARY KEY,
	usuario_id INT NOT NULL,
	realizada_em DATETIME NOT NULL,
	FOREIGN KEY (usuario_id) REFERENCES usuario_relatorio(id)
) ENGINE=InnoDB;

CREATE TABLE item_venda (
	venda_id INT NOT NULL,
	produto_id INT NOT NULL,
	quantidade INT NOT NULL,
	valor_unitario DECIMAL(10,2) NOT NULL,
	PRIMARY KEY (venda_id, produto_id),
	FOREIGN KEY (venda_id) REFERENCES venda(id) ON DELETE CASCADE,
	FOREIGN KEY (produto_id) REFERENCES produto_relatorio(id),
	CHECK (quantidade > 0)
) ENGINE=InnoDB;
```
