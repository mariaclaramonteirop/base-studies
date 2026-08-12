# Qualidade De Projeto de Software

## Abstração
    Abstrair um projeto é isolar os aspectos essenciais de um sistema, ignorando detalhes irrelevantes. A abstração permite que os desenvolvedores se concentrem nos elementos mais importantes do projeto, facilitando a compreensão e a comunicação entre a equipe.

        - Alto Nivel =>

        - Baixo Nivel =>

## Modularidade
    Um projeto modular é aquele que é dividido em módulos ou componentes independentes, cada um responsável por uma parte específica do sistema. A modularidade facilita a manutenção, a reutilização e a escalabilidade do software, permitindo que os desenvolvedores trabalhem em diferentes partes do projeto de forma isolada.

## Encapsulamento
    O encapsulamento é o princípio de ocultar os detalhes internos de um módulo ou componente, expondo apenas uma interface pública para interação com outros módulos. Isso promove a segurança e a integridade do sistema, evitando que partes externas acessem ou modifiquem diretamente os dados internos.
        - As informações de um modulo devem ser Inacessíveis a outros modulos.
        - Um modulo deve ser independente de outros modulos, ou seja, não deve depender de outros modulos para funcionar corretamente.
        - Um modulo deve conhecer apenas o que é necessário para realizar sua função, evitando acoplamento desnecessário.

## Independência funcional
    A independência funcional refere-se à capacidade de um módulo ou componente de operar de forma autônoma, sem depender de outros módulos para realizar suas funções. Isso aumenta a robustez do sistema, permitindo que mudanças em um módulo não afetem outros módulos, facilitando a manutenção e a evolução do software.

1) Explique o conceito de Abstração.
    Abstração é o processo de identificar e isolar os aspectos essenciais de um sistema, ignorando detalhes irrelevantes, permitindo que os desenvolvedores se concentrem nos elementos mais importantes do projeto.

2) Cite 2 características de qualidade de um bom projeto.
        ▪ Ser descomplicado de entender;
        ▪ Ser simples de implementar;
        ▪ Ser fácil de validar e testar;
        ▪ Ser flexível quanto a alterações;
        ▪ Ser fiel às especificações de requisito e de análise.

3) Apresente as vantagens de um projeto modularizado.
        ▪ Facilita a manutenção do software;
        ▪ Permite a reutilização de módulos em diferentes projetos;
        ▪ Facilita a escalabilidade do sistema;
        ▪ Permite que os desenvolvedores trabalhem em diferentes partes do projeto de forma isolada.

4) Por que um projeto deve apresentar alta coesão e baixo acoplamento?
    Um projeto deve apresentar alta coesão e baixo acoplamento para garantir que os módulos sejam independentes e focados em uma única responsabilidade. A alta coesão facilita a compreensão e a manutenção do código, enquanto o baixo acoplamento reduz a dependência entre os módulos, permitindo que mudanças em um módulo não afetem outros, aumentando a flexibilidade e a robustez do sistema.