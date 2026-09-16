- Retornando código errado nos erros da API -> para a P2

- Esquecer de validar o tipo do id -> se é numérico e > 0 -> prestar atenção nas validações

- Esquecer de retornar como objeto ao obter (método que usa o select)

- Para usar o trait dentro da classe-> USE TRAIT;

- ordem na inclusão de arquivos
  - NAMESPACE
  - REQUIRE/INCLUDE
  - USE namespaceExterno;
 
- Ordem classe que extende 1 classe e 2 interfaces
  ```
      class class1 extends classe2 implements interface1 , interface2{}
  ```

- USAR Métodos e Atributos estáticos -> `SELF::$ATRIBUTO` || `SELF::METODO()`
- Usar Métodos e construtor da classe pai -> `PARENT::METODO()`
