<?php



class Estoque{
    
    private int $id;
    private Produto $produto;
    private Setor $setor;
    private int $quantidade;

    public function __construct(
        int $id,
        Produto $produto,
        Setor $setor,
        int $quantidade
    )
    {
        $this->id = $id;
        $this->produto = $produto;
        $this->setor = $setor;
        $this->quantidade = $quantidade;
        $this->validar();
    }

    public function validar(){
        $erros = [];

        if( $this->id <= 0){
            $erros[] = "ID inválido. Deve ser maior que 0";
        } else if(!is_numeric($this->quantidade) || $this->quantidade < 1){
            $erros[] = "Quantidade inválida. Deve ser um número maior que 0";
        }

        if(count($erros) > 0){
            throw new Exception(implode(", ", $erros));
        }
    }


    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of produto
     */
    public function getProduto(): Produto
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     */
    public function setProduto(Produto $produto): self
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get the value of setor
     */
    public function getSetor(): Setor
    {
        return $this->setor;
    }

    /**
     * Set the value of setor
     */
    public function setSetor(Setor $setor): self
    {
        $this->setor = $setor;

        return $this;
    }

    /**
     * Get the value of quantidade
     */
    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    /**
     * Set the value of quantidade
     */
    public function setQuantidade(int $quantidade): self
    {
        $this->quantidade = $quantidade;

        return $this;
    }
}