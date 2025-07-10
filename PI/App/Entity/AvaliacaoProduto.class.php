<?php

require_once(__DIR__ . '/../DB/Database.php');

require_once 'Avaliacao.class.php';


class AvaliacaoProduto extends Avaliacao{

    public int $id_produto;


    public function cadastrarAvaliacaoProduto(){
        $db = new Database('avaliacao_produto');
        $result = $db->insert([
            'comentario'=> $this->comentario,
            'notas' => $this->notas,
            'id_cliente' => $this->id_cliente,
            'id_produto' => $this->id_produto
        ]);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function select_avaliacao_produto($id_produto) {
       $db = new Database('avaliacao_produto');
       $result = $db->select_avaliacao_produto($id_produto);
       
       return $result;
    }
}
