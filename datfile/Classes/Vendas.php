<?php


namespace Classes;


class Vendas {

    const ID = '003';

    private $dados;

    /**
     * Vendas constructor.
     * @param $dados
     */
    public function __construct($dados){

        //Formata dados em array com layout definido.
        $layout = array('id','id_vendedor','itens','nome_do_vendedor');

        //Formata dados em array com layout definido.
        $this->dados = array_combine($layout,$dados);

        $this->dados['itens'] = $this->processarVendas($this->dados['itens']);
    }

    /**
     * Realiza processamento necessário para organizar as vendas.
     * @param $vendas
     * @return array
     */
    private function processarVendas($vendas){

        //Remove caracteres que não são importantes
        //para os dados contidos.
        $vendas = str_replace([' ','[',']'],'',$vendas);

        //Define layout para venda.
        $layout_das_vendas = ['id_item','quantidade','preco'];

        //Separa vendas em array
        $vendas = explode(',',$vendas);

        foreach ($vendas as $venda) {
            //Separa dados da venda
            $dados_da_venda = explode('-',$venda);

            //Formata array de vendas
            $vendasFormatadas[] = array_combine($layout_das_vendas,$dados_da_venda);
        }

        return $vendasFormatadas;
    }

    /**
     * Retorna itens da venda.
     * @return mixed
     */
    public function getItens(){
        return $this->dados['itens'];
    }

    /**
     * Retorna nome do vendedor.
     * @return mixed
     */
    public function getNomeVendedor(){
        return $this->dados['nome_do_vendedor'];
    }

}