<?php

require_once 'vendor/autoload.php';

while (true){
    try {

        /**
         * Objeto responsável por gerenciar diretórios.
         * @var Classes\Diretorio $diretorio_de_entrada
         */
        $diretorio_de_entrada = new Classes\Diretorio();
        $diretorio_de_entrada->buscarArquivos();

        foreach ($diretorio_de_entrada->getArquivos() as $nomearquivo) {
            /**
             * Objeto responsável por gerenciar e processar arquivos.
             * @var Classes\Arquivo $arquivo
             */
            $arquivo = new Classes\Arquivo($nomearquivo);
            $arquivo
                ->validar()
                ->carregar()
                ->processar()
                ->exportarRelatorio();
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    sleep(1);
}