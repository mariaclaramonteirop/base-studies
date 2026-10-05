<?php
require_once 'Estado.php';
require_once 'DominioException.php';
class Cidade{

    public function __construct(
        public int $id = 0,
        public  string $nome = '',
        public  Estado|null $estado = null
    ){
        $this->validar();
    }

    public function validar(): void{
        $tamanhoNome = mb_strlen($this->nome);
        if($tamanhoNome < 3 || $tamanhoNome > 60){
            throw new DominioException("O nome da cidade deve ter entre 3 e 60 caracteres.");
        }
    }
}