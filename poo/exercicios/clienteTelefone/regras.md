'Crie as classes e interfaces do modelo acima. Para isso, considere que:
    a. Cada classe/interface deve ficar em um arquivo PHP próprio, tal como Telefone.php.

    b. As classes Cliente e Telefone possui atributos públicos e o método validar delas deve
    retornar um array contendo os problemas encontrados na validação de seus atributos (ou
    um array vazio se não houver problemas). As seguintes validações devem ocorrer:
        i. Um telefone deve ter 11 caracteres, contendo apenas números;
        ii. O nome de um cliente deve ter de 2 a 100 caracteres;
        iii. Um cliente deve validar seus próprios telefones – logo, seu método de validação
        também deve retornar eventuais problemas com os telefones.

    c. A classe RepositorioException seja a única exceção lançada pelos métodos de
    implementações de RepositorioCliente;

    d. Que a interface RepositorioCliente representa um repositório de clientes, com operações
    para cadastrar, remover um cliente com certo id e obter todos os clientes. A interface não
    deve expor qualquer tecnologia a ser utilizada em uma possível implementação do
    repositório;

    e. Que a classe RepositorioClienteEmBDR implemente a interface acima para realizar as
    operações no banco de dados “acme” descrito anteriormente, utilizando PDO. A instância
    de PDO não deve ser criada pelo repositório. Deve-se utilizar controle de transação
    quando necessário.

2. Crie um script “app.php” que faça uso dos arquivos criados anteriormente e contenha as opções
para cadastrar um cliente, listar todos os clientes e remover um cliente pelo seu id. O cadastro
de cliente deve permitir cadastrar quantos telefones forem desejados e deve validar os dados
antes . A listagem de clientes deve exibir no máximo dois telefones para cada cliente e cada
cliente deve ser exibido em uma linha.