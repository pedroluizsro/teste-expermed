<?php


namespace Classes;


class Vendedor {

    const ID = '001';

    private $dados;

    /**
     * Vendedor constructor.
     * @param $dados
     */
    public function __construct($dados){

        //monta layout identificado.
        $layout = array('id','cpf','nome','salario');

        //Formata dados em array com layout definido.
        $this->dados = array_combine($layout,$dados);
    }
}