<?php
require_once "StatusCompromisso.php";

class Compromisso{

    public function __construct( //promoção de parametro para atributo - ao fazer o encapsulamento nos parametros, eles são promovidos a atributos
        public readonly int $id, // readonly - promoção dos atributos a "constantes", uma vez que um valor é atribuido a uma variavel, ela não pode ser modificadax
        public readonly string $descricao,
        public readonly string $data,
        public readonly string $hora,
        public readonly StatusCompromisso $status
    )
    {}


    public function validar(){
        if($this->id < 0){
            throw new RuntimeException('Id não pode ser menor que ZERO');
        }
        $tamanhoDescricao = mb_strlen($this->descricao);
        if($tamanhoDescricao <3 || $tamanhoDescricao > 50){
            throw new RuntimeException('Descrição deve ter entre 3 e 50 caracteres');
        }
        $partesData = explode('-', $this->data);
        if(count($partesData) != 3){
            throw new RuntimeException('Data deve ter dia, mes e ano');
        }
        [$ano, $mes, $dia] = $partesData;
        if(!checkdate($ano, $mes, $dia)){
            throw new RuntimeException('Data incorreta');
        }
        $partesHora = explode(':', $this->hora);
        if(count($partesHora) < 2 || count($partesHora) > 3){
            throw new RuntimeException('Horario está incorreto');
        }
        [$hora, $minuto] = $partesHora;
        if($hora < 0 || $hora > 23 || $minuto < 0 || $minuto > 59  ){
            throw new RuntimeException('Horario está incorreto. Hora ou minuto são invalidos.');
        }
    }
}