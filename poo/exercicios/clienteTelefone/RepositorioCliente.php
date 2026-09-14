<?php

namespace poo\exercicios\clienteTelefone;

interface RepositorioCliente{
    public function adicionar(Cliente $cliente):void;
    public function atualizar(Cliente $cliente):void;
    public function remover(int $id):void;
    public function todos():array;
}