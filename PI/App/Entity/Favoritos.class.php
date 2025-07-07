
<?php

require_once(__DIR__ . '/../DB/Database.php');


class Favoritos {


    public int $cliente_id_cliente;
    public int $produto_id_produto;
    public string $status_favoritos;


    public function cadastrar(){

        $db = new Database('favoritos');

        $result = $db->insert([
            'cliente_id_cliente' => $this->cliente_id_cliente,
            'produto_id_produto' => $this->produto_id_produto,
            'status_favoritos' => $this->status_favoritos
        ]);


        if($result){
            return true;
        }else{
            return false;
        }

    }


    public function removerFavorito($idCliente, $productId){
        return (new Database('favoritos'))->delete(
            "cliente_id_cliente = '" . $idCliente . "' AND produto_id_produto = " . $productId
        );
    }



    public static function getFavoritosByIdUser($id_cliente){

        return (new Database('favoritos'))->select_produto_favoritos($id_cliente);

    }

    


    
    
    



}