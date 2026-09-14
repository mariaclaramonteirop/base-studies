<?php
namespace poo\exercicios\clienteTelefone;
use poo\exercicios\clienteTelefone\Telefone;
class Cliente{
    public int $id;
    public string $nome;
    public array $telefones;

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

    public function validar(): array {
        $problemas = [];
        if($this->id <= 0) $problemas[] = "ID inválido";

        if(strlen($this->nome) < 2 || strlen($this->nome) > 100) {
            $problemas[] = "Nome deve ter entre 2 e 100 caracteres";
        }

        foreach($this->telefones as $tel) {
            $telesProblemas = $tel->validar();
            if(!empty($telesProblemas)) {
                $problemas[] = "Telefone inválido: " . implode(", ", $telesProblemas);
            }
        }

        return $problemas;
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