<?php

namespace poo\exercicios\clienteTelefone;

class Telefone{

    public int $id;
    public string $numero;
    public function __construct(
        int $id,
        string $numero

    ){
        $this->id = $id;
        $this->numero = $numero;
        $this->validar();
    }

    public function validar(): array{
        $problemas = [];
        if($this->id <= 0){
            $problemas[] = "ID inválido";
        }
        if(empty($this->numero)){
            $problemas[] = "Número inválido";
            return false;
        }
        if(strlen($this->numero) !== 11){
            $problemas[] = "Número deve ter 11 caracteres";
            return false;
        }
        if(!is_numeric($this->numero)){
            $problemas[] = "Número deve conter apenas números";
            return false;
        }
        // se fosse com REGEX, poderia ser assim:
        // if(!preg_match('/^\d{11}$/', $this->numero)){
        //     $problemas[] = "Número deve conter apenas números e ter 11 caracteres";
        //     return false;
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