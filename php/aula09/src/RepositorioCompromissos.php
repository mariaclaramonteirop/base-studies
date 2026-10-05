<?php

interface RepositorioCompromissos{

    /**
     * Obtém todos os Compromissos
     * @param string $pesquisa
     * @return Compromisso[]
     */
    public function todos(string $pesquisa = ''):array;

    /**
     * Adiciona um compromisso ou atualiza um compromisso existente
     * @param Compromisso $c
     * @return void
     */
    public function adicionar(Compromisso $c);

    /**
     * Remover um compromisso pelo id
     * @param int $id
     * @return bool
     */
    public function removerPeloId(int $id):bool;
}