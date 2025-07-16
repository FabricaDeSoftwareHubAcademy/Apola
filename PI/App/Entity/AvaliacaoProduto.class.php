<?php

require_once 'Avaliacao.class.php';
require_once(__DIR__ . '/../DB/Database.php');

use App\DB\Database;



class AvaliacaoProduto extends Avaliacao{

    public int $id_produto;

    public function cadastrasAvaliacaoProduto(){
        $db = new Database('avaliacao_produto');
        $result = $db->insert();

        if($result){
            return true;
        }else{
            return false;
        }
    }
}
