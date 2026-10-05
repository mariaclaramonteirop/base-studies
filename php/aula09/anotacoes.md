## considerações

### estrutura

Classes

    Compromisso
    - id: int
    - descricao: string
    - data: Date
    - hora: Time

    StatusCompromisso (enum)
    - AGENDADO
    - CANCELADO
    - REALIZADO

    RepositorioCompromisso (interface)
    + todos()
    + adicionar()
    + removerPeloId() 