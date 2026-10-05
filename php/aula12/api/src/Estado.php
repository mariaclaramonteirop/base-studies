<?php

class Estado{

    public function __construct(
        public int $id = 0,
        public string $nome = '',
        public string $uf = ''
    ){
        $this->validar();
    }

    public function validar(): void{
        // TODO
    }
}