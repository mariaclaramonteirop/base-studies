<?php

namespace poo\exercicios\clienteTelefone;

class Telefone{

    private int $id;
    private string $numero;
    public function __construct(
        int $id,
        string $numero

    ){
        $this->id = $id;
        $this->numero = $numero;
        $this->validar();
    }

    public function validar(): bool{
        if($this->id <= 0){
            return false;
        }
        if(empty($this->numero)){
            return false;
        }
        return true;
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
     * Get the value of numero
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     */
    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}