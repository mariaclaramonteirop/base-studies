<?php

class Setor{

    private  int $id;
    private  string $codigo;
    private  string $nome;

    public function __construct(
        int $id,
        string $codigo,
        string $nome
    )
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nome = $nome;
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
     * Get the value of codigo
     */
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     */
    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }
}