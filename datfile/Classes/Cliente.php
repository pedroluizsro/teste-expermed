<?php


namespace Classes;


class Cliente {

    const ID = '002';

    private $dados;

    /**
     * Cliente constructor.
     * @param $dados
     */
    public function __construct($dados){

        $layout = array('id','cnpj','nome','ramo_de_atividade');

        //Formata dados em array com layout definido.
        $this->dados = array_combine($layout,$dados);
    }
}