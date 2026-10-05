<?php


interface RepositorioCidade{
    public function adicionar(Cidade $cidade): void;
    public function atualizar(Cidade $cidade): bool;
    public function obterIdCidadeComNome(string $nome): ?Cidade;
}