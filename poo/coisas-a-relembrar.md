# POO: conceitos para relembrar

Anotações de Programação Orientada a Objetos com exemplos práticos em PHP.

## Índice

- [Fundamentos](#fundamentos)
- [Relacionamentos](#relacionamentos)
- [Herança e polimorfismo](#herança-e-polimorfismo)
- [Recursos do PHP](#recursos-do-php)
- [Modelagem e boas práticas](#modelagem-e-boas-práticas)
- [Exercícios](#exercícios)

## Fundamentos

- **Classe**: molde que define dados e comportamentos.
- **Objeto**: instância concreta de uma classe.
- **Atributo**: dado que representa o estado do objeto.
- **Método**: ação ou comportamento do objeto.
- **Construtor**: `__construct()`, executado ao criar o objeto.
- **Encapsulamento**: protege o estado interno e expõe apenas operações válidas.
- **Abstração**: mostra apenas o que é importante para o problema.

Exemplo real: um pedido de compra controla seus itens e calcula o total.

```php
final class Pedido
{
    private array $precos = [];

    public function __construct(private int $numero)
    {
    }

    public function adicionarItem(float $preco): void
    {
        if ($preco <= 0) {
            throw new InvalidArgumentException('O preco deve ser positivo.');
        }

        $this->precos[] = $preco;
    }

    public function total(): float
    {
        return array_sum($this->precos);
    }
}

$pedido = new Pedido(1001);
$pedido->adicionarItem(49.90);
echo $pedido->total(); // 49.9
```

O atributo `precos` é privado: ninguém consegue inserir um valor inválido diretamente. Essa é a aplicação prática do encapsulamento.

## Relacionamentos

- **Associação**: um objeto conhece ou usa outro. Exemplo: `Cliente` consulta seus pedidos.
- **Agregação**: um objeto recebe outro que continua existindo de forma independente. Exemplo: um `Time` recebe jogadores.
- **Composição**: o objeto principal cria e controla partes que fazem sentido dentro dele. Exemplo: um `Pedido` cria suas linhas.
- **Dependência**: um objeto usa outro durante uma operação, geralmente recebido como parâmetro ou construtor.

```php
final class RelatorioPedidos
{
    public function __construct(private PedidoRepository $repositorio)
    {
    }

    public function gerar(): array
    {
        return $this->repositorio->buscarTodos();
    }
}
```

`RelatorioPedidos` depende de `PedidoRepository`. Receber a dependência facilita trocar a implementação e criar testes com um repositório falso.

## Herança e polimorfismo

- **Herança**: uma subclasse reaproveita e especializa uma superclasse. Use quando existe uma relação real de “é um”.
- **Sobrescrita**: a subclasse redefine um método herdado com assinatura compatível.
- **Polimorfismo**: o código cliente usa um contrato comum, e cada objeto executa seu próprio comportamento.
- **Interface**: contrato de métodos que uma classe deve implementar.
- **Classe abstrata**: base que pode compartilhar código, mas não pode ser instanciada.
- **Classe concreta**: classe completa, que pode ser instanciada.

Exemplo real: o checkout aceita qualquer meio de pagamento.

```php
interface MeioDePagamento
{
    public function pagar(float $valor): string;
}

final class PagamentoPix implements MeioDePagamento
{
    public function pagar(float $valor): string
    {
        return "Pix de R$ {$valor} criado";
    }
}

final class PagamentoCartao implements MeioDePagamento
{
    public function pagar(float $valor): string
    {
        return "Cartao de R$ {$valor} autorizado";
    }
}

function finalizarCompra(MeioDePagamento $meio, float $valor): string
{
    return $meio->pagar($valor);
}

echo finalizarCompra(new PagamentoPix(), 100);
echo finalizarCompra(new PagamentoCartao(), 100);
```

## Recursos do PHP

### `final`

Uma classe `final` não pode ser herdada. Um método `final` não pode ser sobrescrito. Use para proteger uma regra que não deve ser alterada, como uma política de cálculo.

### `static`

Membros estáticos pertencem à classe, e não a uma instância. São úteis para funções sem estado, mas o excesso de uso aumenta o acoplamento e dificulta testes.

```php
final class Documento
{
    public static function gerarNumero(): string
    {
        return 'DOC-' . date('YmdHis');
    }
}

echo Documento::gerarNumero();
```

### Sobrecarga

PHP não permite declarar dois métodos com o mesmo nome e assinaturas diferentes. Para comportamentos opcionais, use parâmetros padrão, `...$argumentos` ou métodos mágicos como `__call()` quando realmente necessário.

```php
final class Busca
{
    public function executar(string $termo, int $pagina = 1): array
    {
        return ['termo' => $termo, 'pagina' => $pagina];
    }
}

$busca = new Busca();
$busca->executar('php');
$busca->executar('php', 2);
```

### Trait

Trait compartilha implementação entre classes que não precisam estar na mesma hierarquia.

```php
trait RegistraLog
{
    public function logar(string $mensagem): void
    {
        error_log($mensagem);
    }
}

final class ServicoEmail
{
    use RegistraLog;
}
```

### Exceções

Exceções representam situações excepcionais e separam o fluxo normal do tratamento de erro.

```php
try {
    $pedido->adicionarItem(-10);
} catch (InvalidArgumentException $erro) {
    echo $erro->getMessage();
}
```

### SPL, PSR e Composer

- **SPL**: biblioteca padrão do PHP. Exemplo: `ArrayIterator` para percorrer uma coleção como objeto.
- **PSR**: recomendações do PHP-FIG, como PSR-4 para autoloading e PSR-12 para estilo de código.
- **Composer**: gerencia dependências e autoloading. O fluxo comum é `composer require fornecedor/pacote` e depois `require 'vendor/autoload.php';`.

## Modelagem e boas práticas

### Modelo anêmico

É uma classe com apenas atributos e getters/setters, enquanto toda a regra fica em outro lugar. Pode ser aceitável para DTOs simples, mas é ruim quando o objeto deveria proteger regras de negócio.

```php
// Anemico: qualquer parte do sistema pode definir um saldo invalido.
final class ContaAnemica
{
    public float $saldo;
}

// Comportamental: a classe protege suas regras.
final class Conta
{
    private float $saldo = 0;

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new InvalidArgumentException('Valor invalido.');
        }

        $this->saldo += $valor;
    }
}
```

### Imutabilidade e métodos imutáveis

Um objeto imutável não muda depois de criado. Em vez de alterar o objeto atual, o método retorna uma nova instância.

```php
final class EmailDoUsuario
{
    public function __construct(private string $valor)
    {
        if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('E-mail invalido.');
        }
    }

    public function valor(): string
    {
        return $this->valor;
    }

    public function comNovoValor(string $valor): self
    {
        return new self($valor);
    }
}

$antigo = new EmailDoUsuario('maria@example.com');
$novo = $antigo->comNovoValor('contato@example.com');
```

Classes imutáveis são úteis para valores como e-mail, dinheiro, data e endereço, pois reduzem efeitos colaterais.

## Exercícios

### 1. Conta bancária: iniciante

Crie uma classe `ContaBancaria` com:

- atributo privado `saldo` iniciado em zero;
- método `depositar(float $valor)`;
- método `sacar(float $valor)`;
- método `saldoAtual()`;
- exceção para depósito não positivo e saque maior que o saldo.

Teste criando uma conta, depositando `500`, sacando `120` e verificando o resultado `380`.

### 2. Carrinho de compras: iniciante

Crie as classes `Produto` e `Carrinho`.

- `Produto` deve ter nome e preço;
- `Carrinho` deve adicionar produtos;
- o método `total()` deve somar os preços;
- rejeite produtos com preço zero ou negativo.

Desafio: adicione um método que aplique um desconto percentual sem alterar o preço original dos produtos.

### 3. Notificações: intermediário

Crie uma interface `Notificador` com o método `enviar(string $mensagem): void`.

Implemente `NotificadorEmail`, `NotificadorSms` e `NotificadorWhatsApp`. Depois, crie uma função que receba `Notificador` e envie a mesma mensagem sem verificar qual classe foi recebida. Isso pratica polimorfismo.

### 4. Relatório com injeção de dependência: intermediário

Crie uma interface `RepositorioUsuario` com `buscarTodos(): array`.

Implemente `RepositorioUsuarioMemoria`, que retorna dados fixos, e `RelatorioUsuarios`, que recebe o repositório no construtor e gera a quantidade de usuários.

Escreva um teste manual usando o repositório em memória, sem conexão com banco de dados.

### 5. Pedido e status: avançado

Crie uma classe `Pedido` com os estados `novo`, `pago`, `enviado` e `cancelado`.

- permita apenas transições válidas;
- impeça o cancelamento depois do envio;
- lance uma exceção para transições inválidas;
- mantenha o estado privado;
- use métodos como `pagar()`, `enviar()` e `cancelar()` em vez de um setter genérico.

### 6. Valor imutável: avançado

Crie uma classe imutável `Dinheiro` com valor e moeda.

- valide que a moeda tenha três letras;
- implemente `somar(Dinheiro $outro): self`;
- impeça somar moedas diferentes;
- garanta que os objetos originais não sejam alterados.
+
+Exemplo esperado: `R$ 10` somado a `R$ 5` deve retornar um novo objeto com `R$ 15`.
+
+### Checklist de revisão
+
- A classe protege suas regras ou é apenas um conjunto de getters e setters?
- Uma interface ou composição resolveria melhor que herança?
- Os nomes representam o domínio real?
- Os métodos têm uma responsabilidade clara?
- Os casos inválidos lançam exceções?
- O comportamento pode ser testado sem banco ou serviço externo?
