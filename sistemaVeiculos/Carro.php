<?php

namespace SistemaVeiculos;
use SistemaVeiculos\Veiculo;

class Carro extends Veiculo{

    public function acelerar(int $velocidade): void{
        $velocidadeAtual = $this->getVelocidade();
        $velocidadeMaxima = $this->getVelocidadeMaxima();

        if($velocidade < 0){
            throw new \Exception("Velocidade inválida. Não pode ser negativa");
        }

        if($velocidadeAtual + $velocidade > $velocidadeMaxima){
            throw new \Exception("Velocidade máxima excedida");
        }
        $this->setVelocidade($velocidadeAtual + $velocidade);
    }
}