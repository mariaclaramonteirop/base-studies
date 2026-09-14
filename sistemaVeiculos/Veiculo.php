<?php

namespace SistemaVeiculos;

abstract class Veiculo {
    private string $modelo;
    private string $marca;
    private int $velocidade;
    private int $velocidadeMaxima;

    public function __construct(string $modelo, string $marca, int $velocidadeMaxima){
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->velocidadeMaxima = $velocidadeMaxima;
        $this->velocidade = 0;
        $this->validar();
    }

    /**
     * Método abstrato que deve ser implementado pelas classes filhas
     */
    abstract function acelerar(int $velocidade): void;

    public function info(): string{
        return "Modelo: {$this->modelo}, Marca: {$this->marca}, Velocidade: {$this->velocidade} km/h, Velocidade Máxima: {$this->velocidadeMaxima} km/h";
    }

    public function validar(): array{
        $problemas = [];
        if(empty($this->modelo)){
            $problemas[] = "Modelo inválido. Não pode ser vazio";
        }
        if(empty($this->marca)){
            $problemas[] = "Marca inválida. Não pode ser vazia";
        }
        if($this->velocidade < 0){
            $problemas[] = "Velocidade inválida. Não pode ser negativa";
        }
        if($this->velocidadeMaxima <= 0){
            $problemas[] = "Velocidade máxima inválida. Deve ser maior que zero";
        }
        return $problemas;  // SEMPRE retorna array
    }

    /**
     * Get the value of modelo
     */
    public function getModelo(): string
    {
        return $this->modelo;
    }

    /**
     * Set the value of modelo
     */
    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get the value of marca
     */
    public function getMarca(): string
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     */
    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get the value of velocidade
     */
    public function getVelocidade(): int
    {
        return $this->velocidade;
    }

    /**
     * Set the value of velocidade
     */
    public function setVelocidade(int $velocidade): self
    {
        $this->velocidade = $velocidade;

        return $this;
    }

    /**
     * Get the value of velocidadeMaxima
     */
    public function getVelocidadeMaxima(): int
    {
        return $this->velocidadeMaxima;
    }

    /**
     * Set the value of velocidadeMaxima
     */
    public function setVelocidadeMaxima(int $velocidadeMaxima): self
    {
        $this->velocidadeMaxima = $velocidadeMaxima;

        return $this;
    }
}