<?php

namespace Classes;



class Arquivo extends Diretorio {

    const EXTENSAO = 'dat';

    private $arquivo;
    private $conteudo;
    private $relatorio = Relatorio::class;

    /**
     * Arquivo constructor.
     * @param $nomearquivo
     * @throws \Exception
     */
    public function __construct($nomearquivo){

        //Verifica se nome do arquivo foi preenchido
        //e se o nome do arquivo possui a extensão .dat
        if(!$nomearquivo OR !preg_match('/.*\.'.self::EXTENSAO.'$/',$nomearquivo)){
            throw new \Exception('Arquivo inválido!');
        }

        //Concatena diretório com nome do arquivo.
        $this->arquivo = $this->datain.$nomearquivo;
    }

    /**
     * Realiza validações nessárias
     * verificando a integridade do arquivo.
     * @return $this
     * @throws \Exception
     */
    public function validar(){

        //Verifica se arquivo existe.
        if(!file_exists($this->arquivo)){
            throw new \Exception('Arquivo não encontrado.');
        }

        //Valida extensão do arquivo.
        if(pathinfo($this->arquivo,PATHINFO_EXTENSION) != self::EXTENSAO){
            throw new \Exception('Extensão de arquivo inválida.');
        }

        return $this;
    }

    /**
     * Carrega conteúdo do arquivo.
     * @return $this
     * @throws \Exception
     */
    public function carregar(){

        //Carrega conteudo do arquivo.
        $arquivo = file_get_contents($this->arquivo);

        //Separa conteudo do arquivo em um array por linhas.
        $this->conteudo = explode(PHP_EOL,$arquivo);

        if(!$this->conteudo OR empty($this->conteudo)){
            throw new \Exception('Arquivo vazio');
        }

        return $this;
    }

    /**
     * Realiza processamento necessário para compreendimento dos dados
     * e geração de relatórios.
     * @return $this
     */
    public function processar(){

        foreach ($this->conteudo as $linha) { //Percorre cada linha do arquivo

            //Utiliza separador identificado no arquivo
            //para separar dados de cada linha.
            $linha_array = explode('ç',$linha);

            //Processa linha já com dados transformados em Array.
            if($linha_array AND is_array($linha_array) AND isset($linha_array[0])){
                switch ($linha_array[0]){
                    case Vendedor::ID:
                        $vendedores[] = new Vendedor($linha_array);
                        break;
                    case Cliente::ID:
                        $clientes[] = new Cliente($linha_array);
                        break;
                    case Vendas::ID:
                        $vendas[] = new Vendas($linha_array);
                        break;
                }
            }
        }

        //Inicializa objeto de relatórios.
        $this->relatorio = new Relatorio($vendedores,$clientes,$vendas);

        return $this;
    }

    public function exportarRelatorio(){

        //Define nome do novo arquivo.
        $novo_arquivo = $this->dataout.pathinfo($this->arquivo,PATHINFO_FILENAME).'.done.dat';

        /**
         * Objeto responsável por gerar relatórios.
         * @var Relatorio $relatorio
         */
        $relatorio = $this->relatorio;

        //Gera relatórios.
        $output = "Vendedores: ".$relatorio->quantidadeDeVendedores().PHP_EOL;
        $output .= "Clientes: ".$relatorio->quantidadeDeClientes().PHP_EOL;
        $output .= "Item que mais gerou receita: ".$relatorio->idDaMaiorVenda().PHP_EOL;
        $output .= "Pior vendedor: ".$relatorio->piorVendedor().PHP_EOL;

        file_put_contents($novo_arquivo,$output,FILE_APPEND);

        //Solução simples para não haver duplicidade no processamento.
        rename($this->arquivo,$this->arquivo.'.processado');

    }
}