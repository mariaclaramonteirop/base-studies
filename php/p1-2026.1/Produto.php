<?php


class Produto{
    private int $id;
    private string $descricao;
    private float $preco;
    private float $totalEstoque;

    public function __construct(
        int $id,
        string $descricao,
        float $preco,
        float $totalEstoque
    )
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->totalEstoque = $totalEstoque;
        $this->validar();
    }

    public function validar(){
        $erros = [];

        if( $this->id <= 0){
            $erros[] = "ID inválido. Deve ser maior que 0";
        }
        else if(isset($this->descricao) || strlen($this->descricao) < 2 || mb_strlen($this->descricao) > 100){
            $erros[] = "Descrição inválida. Deve ter entre 2 e 100 caracteres";
        } else if($this->preco <= 0.50){
            $erros[] = "Preço inválido. Deve ser maior que 0.50";
        }else if($this->totalEstoque < 0){
            $erros[] = "Total em estoque inválido. Deve ser maior ou igual a 0";
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
     * Get the value of descricao
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of preco
     */
    public function getPreco(): float
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     */
    public function setPreco(float $preco): self
    {
        $this->preco = $preco;

        return $this;
    }
}