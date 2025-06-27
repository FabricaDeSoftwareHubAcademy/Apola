<?php
require_once '../../App/DB/Database.php';

class Pedido {
    public int $id;
    public DATETIME $data_pedido;
    public string $tipo;
    public string $status_pedido;
    public string $codigo_rastreio;
    
    public function cadastrar(){
        $db = new Database('pedido');
        $result = $db->insert([
        ]);

        return $result ? true : false;
    }

    public function atualizar($id_pedido){
        return (new Database('pedido'))->update('id_pedido = ' .$id_pedido  ,[
            $status_pedido =
        ]);
    }

    public static function buscar($where = ''){
        return (new Database('pedido'))->select_pedido($where);
    }
    

    public static function buscar_pedido_by_id($id){
        return (new Database('pedido'))->select_pedido_by_id($id)->fetchObject(self::class);
    }

    public function excluir($sacola_id){
        return (new Database('pedido'))->delete('sacola_id_sacola = '.$sacola_id);
    }
    
}
?>