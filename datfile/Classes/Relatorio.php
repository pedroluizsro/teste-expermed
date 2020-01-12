<?php


namespace Classes;


class Relatorio {

    private $vendedores;
    private $clientes;
    private $vendas;

    /**
     * Relatorio constructor.
     * @param $vendedores
     * @param $clientes
     * @param $vendas
     */
    public function __construct($vendedores, $clientes, $vendas){

        $this->vendedores = $vendedores;
        $this->clientes = $clientes;
        $this->vendas = $vendas;

    }

    /**
     * Retorna quantidade de vendedores.
     * @return int
     */
    public function quantidadeDeVendedores(){
        return count($this->vendedores);
    }

    /**
     * Retorna quantidade de clientes.
     * @return int
     */
    public function quantidadeDeClientes(){
        return count($this->clientes);
    }

    /**
     * Retorna o item mais vendido.
     * @return mixed
     */
    public function idDaMaiorVenda(){

        $valor = 0;

        foreach ($this->vendas as $venda) {

            /** @var Vendas $venda */
            $itens = $venda->getItens();

            foreach ($itens as $item) {

                /** @var float $valor_somado */
                $valor_somado = (int) $item['quantidade'] * (float) $item['preco'];

                if($valor < $valor_somado){ //Verifica maior valor.

                    $valor = $valor_somado;
                    $id_item = $item['id_item'];
                }
            }
        }

        return $id_item;
    }

    /**
     * Retorna pior vendedor.
     * O valor que eu escolhi para julgar como pior foi o vendedor que arrecadou menos.
     * @return mixed
     */
    public function piorVendedor(){

        $valor = 0;
        foreach ($this->vendas as $key => $venda) {

            /** @var Vendas $venda */
            $itens = $venda->getItens();

            $valor_somado = 0;
            foreach ($itens as $item) {
                /**
                 * Valores de todas as vendas somadas.
                 * @var float $valor_somado
                 */
                $valor_somado += (int) $item['quantidade'] * (float) $item['preco'];
            }

            //Verifica qual valor menor.
            if($valor_somado < $valor){
                $vendedor = $venda->getNomeVendedor();
                $valor = $valor_somado;
            } else {
                $valor = $valor_somado;
            }

        }

        return $vendedor;
    }

}