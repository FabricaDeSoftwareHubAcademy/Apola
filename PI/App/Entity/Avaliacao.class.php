<?php

require_once __DIR__ . '/../DB/Database.php';

Class Avaliacao{
    public string $comentario;
    public string $notas;
    public int $id_cliente;
    

    public function cadastrarAvaliacao(){
        $db = new Database('avaliacao_loja');
        $result = $db->insert([
            'comentario'=> $this->comentario,
            'notas'=> $this->notas,
            'id_cliente'=> $this->id_cliente
        ]);
        
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function buscarAvaliacao(){
        $db = new Database('avaliacao_loja');

        $result = $db->select_avaliacao_loja();

        return $result;
    }
        
}