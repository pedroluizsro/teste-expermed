<?php


namespace Classes;


class Diretorio {

    protected $datain = 'data/in/';
    protected $dataout = 'data/out/';

    private $arquivos = array();

    /**
     * Busca e retorna arquivos de dentro do diretório de entrada.
     * Já realiza filtro para buscar apenas arquivos com extensão permitida.
     */
    public function buscarArquivos(){
        $this->arquivos = preg_grep('/.*\.'.Arquivo::EXTENSAO.'$/',scandir($this->datain));
    }

    /**
     * Retorna arquivos encontrados.
     * @return array
     */
    public function getArquivos(){
        return $this->arquivos;
    }
}