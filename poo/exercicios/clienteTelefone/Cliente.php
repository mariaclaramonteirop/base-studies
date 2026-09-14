<?php
namespace poo\exercicios\clienteTelefone;
use poo\exercicios\clienteTelefone\Telefone;
class Cliente{
    private int $id;
    private string $nome;
    private array $telefones;

    public function __construct(
        int $id,
        string $nome,
        array $telefones
    ){
        $this->id = $id;
        $this->nome = $nome;
        $this->telefones = $telefones;
        $this->validar();
    }

    public function validar(): bool{
        if($this->id <= 0){
            return false;
        }
        if(empty($this->nome)){
            return false;
        }
        foreach($this->telefones as $telefone){
            if(!$telefone instanceof Telefone || !$telefone->validar()){
                return false;
            }
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

    /**
     * Get the value of telefones
     */
    public function getTelefones(): array
    {
        return $this->telefones;
    }

    /**
     * Set the value of telefones
     */
    public function setTelefones(array $telefones): self
    {
        $this->telefones = $telefones;

        return $this;
    }
}