<?php
/*
ESTRATEGIA DE ESTUDOS E RESOLUCAO DE PROVAS

1. O QUE AS PROVAS MAIS COBRAM

- PHP basico: arrays, foreach, funcoes, validacao e manipulacao de strings.
- SQL: CREATE DATABASE, CREATE TABLE, chaves estrangeiras, JOIN, filtros e agregacoes.
- PDO: conexao unica, prepared statements, bind de valores e transacoes.
- POO: entidades, interfaces, heranca de excecoes e responsabilidades bem separadas.
- MVC: Visao recebe a requisicao e produz a resposta; Controladora coordena; Modelo aplica regras.
- Repository: encapsula o banco e retorna objetos ou arrays de objetos.
- HTTP: metodos, headers, JSON, HTML, status codes, CORS e autenticacao.
- Seguranca: SQL Injection, XSS, validacao de entrada, senhas com hash e protecao de credenciais.

2. ORDEM RECOMENDADA DE ESTUDO

Fase 1 - Arrays e logica
- Resolva os exercicios de arrays sem usar funcoes prontas.
- Depois refaca usando array_unique, sort, rsort, in_array e funcoes de filtragem.
- Treine casos vazios, duplicados, tipos inesperados e valores invalidos.
- Pratique problemas de dominio: carros, animais, inventario, jogos e xadrez.

Fase 2 - SQL
- Escreva CREATE DATABASE e CREATE TABLE sem consultar modelos.
- Identifique entidades, relacionamentos 1:N e N:N.
- Treine SELECT com INNER JOIN e LEFT JOIN.
- Pratique WHERE, ORDER BY, GROUP BY, HAVING e COUNT/SUM/AVG.
- Antes de codificar o PHP, teste cada consulta diretamente no MySQL.

Fase 3 - PHP orientado a objetos
- Crie primeiro as entidades: Usuario, Produto, Pedido, ItemPedido, Fornecedor etc.
- Depois escreva as interfaces dos repositorios.
- Em seguida implemente os repositorios com PDO.
- Crie servicos para regras que envolvam mais de uma entidade ou tabela.
- Por ultimo, crie controladoras e visoes.

Fase 4 - APIs
- Treine primeiro uma rota GET que retorna JSON.
- Depois POST com JSON e POST com application/x-www-form-urlencoded.
- Em seguida PUT, PATCH e DELETE.
- Pratique respostas HTML, XML, upload, webhook, CORS e Bearer Token.
- Sempre teste URL inexistente e metodo nao permitido.

3. COMO COMECAR UMA QUESTAO DE PROVA

Passo 1: Circule as entidades, tabelas, URLs, metodos e formatos de entrada.
Passo 2: Liste as regras de validacao e os relacionamentos entre tabelas.
Passo 3: Desenhe rapidamente as classes e as chaves estrangeiras.
Passo 4: Defina os status HTTP antes de escrever a implementacao.
Passo 5: Escreva e teste o SQL com dados pequenos.
Passo 6: Implemente Repository, depois Service, Controller e View.
Passo 7: Teste sucesso, entrada invalida, registro inexistente e erro de banco.

4. MAPA MVC PARA UMA API

View:
- Le metodo, caminho, query string, headers e corpo da requisicao.
- Valida o formato basico da entrada.
- Chama a Controladora.
- Define status, headers e corpo JSON ou HTML.

Controller:
- Recebe dados ja interpretados pela View.
- Coordena servicos e repositorios.
- Nao acessa $_GET, $_POST, $_SERVER, cookies ou URLs.
- Nao deve conter mensagens especificas de apresentacao.

Service:
- Aplica regras de negocio.
- Valida combinacoes entre entidades.
- Abre transacoes quando uma operacao altera varias tabelas.

Repository:
- Usa PDO e prepared statements.
- Conhece tabelas e JOINs, mas nao conhece HTTP.
- Retorna entidades ou arrays de entidades.
- Traduz falhas do banco para RepositoryException.

5. CHECKLIST DE SQL E JOIN

- Toda chave estrangeira aponta para uma tabela criada antes.
- Relacionamentos N:N possuem tabela intermediaria e chave primaria composta.
- Campos usados em filtro, ordenacao e relacionamento possuem indices quando necessario.
- Nunca concatene entrada do usuario no SQL.
- Use alias para diferenciar campos com o mesmo nome.
- Verifique se o JOIN pode eliminar registros; use LEFT JOIN quando registros sem relacionamento tambem devem aparecer.
- Para relatorios, agrupe apenas pelos campos necessarios e confira se SUM/COUNT nao esta duplicando linhas.

6. STATUS HTTP PARA MEMORIZAR

200 OK: consulta ou atualizacao concluida.
201 Created: recurso criado.
204 No Content: operacao concluida sem corpo, comum em DELETE.
400 Bad Request: requisicao malformada.
401 Unauthorized: ausencia ou invalidade de autenticacao.
403 Forbidden: autenticado, mas sem permissao.
404 Not Found: rota ou recurso inexistente.
405 Method Not Allowed: rota existe, metodo nao permitido.
409 Conflict: duplicidade ou conflito de estado.
422 Unprocessable Entity: dados bem-formados, mas invalidos.
500 Internal Server Error: falha inesperada no servidor.

7. CHECKLIST DE SEGURANCA

- PDO sempre com prepared statements.
- htmlspecialchars ao colocar dados externos em HTML.
- json_decode com verificacao de erro.
- Nunca retornar senha, hash, token ou stack trace.
- Validar tipo, tamanho, formato, obrigatoriedade e limites.
- Nao confiar em preco, total, permissao ou ID enviados pelo cliente.
- Hash de senha com o algoritmo e sal pedidos no enunciado.
- Token e cookie com expiracao, escopo e protecoes adequadas quando o exercicio exigir.
- Em transacoes: beginTransaction, commit no sucesso e rollback em qualquer falha.

8. ROTEIRO DE TREINO DE UMA SEMANA

Dia 1: arrays simples, filtros, duplicatas e ordenacao.
Dia 2: arrays associativos, matrizes, animais, carros e xadrez.
Dia 3: CREATE TABLE, chaves estrangeiras e JOINs.
Dia 4: entidades, interfaces, Repository e PDO.
Dia 5: GET, POST, JSON, validacoes e status HTTP.
Dia 6: PUT, PATCH, DELETE, transacoes, HTML e CORS.
Dia 7: simulado completo com tempo limitado e revisao dos erros.

9. ESTRATEGIA DURANTE A PROVA

- Leia toda a questao antes de codificar.
- Comece pelo SQL e pelas entidades, pois eles definem o restante.
- Faca primeiro o caminho de sucesso.
- Depois cubra validacoes e status de erro.
- Se faltar tempo, priorize: conexao PDO, prepared statement, JOIN correto,
  validacao principal, transacao e resposta HTTP.
- Use nomes claros e mantenha cada classe com uma responsabilidade.
- No final, procure variaveis globais dentro de Controllers, SQL concatenado,
  respostas sem Content-Type e valores de entrada exibidos sem escape.
*/
