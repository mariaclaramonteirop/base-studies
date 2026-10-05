<?php

// FACHADA
class ServicoCadastroCidade {

    public function __construct(
        private readonly RepositorioEstados $repositorioEstado,
        private readonly RepositorioCidade $repositorioCidade,
        )
    {
    }
    public function salvar(array $dados):void{
        $estado = $this->repositorioEstado->estadoComUf($dados['uf']?? '');

        if($estado == null){
            throw new DominioException('O estado não existe');
        }
        $cidade = new Cidade($dados['id']?? 0, $dados['nome']?? '', $estado );

        $idExistente = $this->repositorioCidade->obterIdCidadeComNome($cidade->nome);

        if($cidade->id == 0){
            if($idExistente !== null){
                throw new DominioException('Cidade já cadastrada');
            }
            $this->repositorioCidade->adicionar($cidade);
        }else{
            $encontrou = $this->repositorioCidade->atualizar($cidade);
            if(!$encontrou){
                throw new DominioException('Cidade não encontrada');
            }
        }
    }
}