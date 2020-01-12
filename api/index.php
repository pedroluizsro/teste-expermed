<?php

if($_FILES AND is_array($_FILES)){
    foreach ($_FILES as $arquivo) {
        if($arquivo AND preg_match('/.*\.'.'dat'.'$/',$arquivo['name'])){
            //Define novo nome e caminha do arquivo.
            $novo_arquivo = '/var/www/html/datfile/data/in/'.$arquivo['name'];

            //Realiza salvamento do arquivo em novo local.
            if(move_uploaded_file($arquivo['tmp_name'],$novo_arquivo)){
                $retorno[] = 'Upload do arquivo '.$arquivo['name'].' realizado.';
            } else {
                $retorno[] = 'Falha ao realizar upload do arquivo: '.$arquivo['name'].'.';
            }
        } else {
            $retorno[] = 'Arquivo '.$arquivo['name'].' inválido.';
        }
    }

    echo json_encode($retorno);
}