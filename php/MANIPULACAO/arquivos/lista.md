# Exercícios de Manipulação de Arquivos

Esta lista pratica criação, leitura, escrita, cópia, organização e segurança no trabalho com arquivos e diretórios em PHP.

## Lista 1: Arquivos e Diretórios

### 1. Leitura de Texto

Leia um arquivo `anotacoes.txt` e exiba seu conteúdo, o número de linhas e o número total de caracteres.

* **Objetivo:** Tratar o caso em que o arquivo não existe ou não pode ser lido.

### 2. Escrita de Log

Crie uma função que registre mensagens em `logs/app.log`, adicionando data, hora, nível (`INFO`, `WARNING` ou `ERROR`) e descrição.

* **Objetivo:** Acrescentar novas mensagens sem apagar as anteriores e criar a pasta de logs quando necessário.

### 3. Cópia e Organização

Percorra uma pasta de documentos e copie arquivos para subpastas conforme a extensão: imagens, textos, planilhas e outros.

* **Objetivo:** Ignorar diretórios, preservar os nomes dos arquivos e informar conflitos de nomes sem sobrescrever arquivos existentes.

### 4. Busca Recursiva

Crie uma função que percorra uma pasta e todas as suas subpastas, retornando os caminhos dos arquivos que possuem uma extensão informada.

* **Objetivo:** Usar `RecursiveDirectoryIterator` e permitir que arquivos ocultos ou inacessíveis sejam tratados sem interromper toda a busca.

### 5. Upload Seguro

Implemente a rotina de recebimento de um arquivo enviado por formulário.

* **Objetivo:** Validar erro de upload, tamanho máximo, extensão permitida, MIME type, nome aleatório e destino fora da pasta pública quando possível. Nunca confie apenas no nome original do arquivo.

### 6. Controle de Versões de Arquivo

Crie uma função que salve novas versões de um arquivo de configuração sem apagar a versão anterior, usando nomes como `config-2026-10-03-120000.json`.

* **Objetivo:** Criar o diretório de versões, impedir nomes inválidos, listar as versões existentes e recuperar a versão mais recente.
