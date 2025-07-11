<?php
require_once '../../App/DB/Database.php';

class Pedido {
    public string $data_pedido;
    public string $tipo;
    public string $status_pedido;
    public ?string $codigo_rastreio = null;
    public ?int $produto_perso_id_produto_perso;
    public ?int $id_cliente;
    
    public function cadastrar(){
        $db = new Database('pedido');
        $result = $db->insert([
            // inserir os campos e valores
        ]);

        return $result ? true : false;
    }
    public function cadastrarPerso($id){
        $db = new Database('pedido');
        $result = $db->insert([
            // inserir os campos e valores
        ]);

        return $result ? true : false;
    }

    public function buscarTodosPedidos($where = null, $order = null, $limit = null) {
        return (new Database('pedido'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function atualizar(){
        return (new Database('pedido'))->update('sacola_id_sacola = '.$this->sacola_id_sacola,[
            // campos para atualizar
        ]);
    }

    public static function buscar($where = ''){
        return (new Database('pedido'))->select_pedido($where);
    }
    
    public static function buscar_pedido_by_id($id){
        return (new Database('pedido'))->select_pedido_by_id($id)->fetchObject(self::class);
    }
    public static function buscar_pedidoperso_by_id($id){
        return (new Database('pedido'))->select_pedido_personalizado_by_id($id)->fetchObject(self::class);
    }
    

    public function excluir($sacola_id){
        return (new Database('pedido'))->delete('sacola_id_sacola = '.$sacola_id);
    }
    public function atualizarPedido($id){
        $db = new Database('pedido');
        $res = $db->update('id_pedido = '.$id, [
            'codigo_rastreio' => $this->codigo_rastreio,
            'status_pedido' => $this->status_pedido,
            'valor_total_perso' => $this->valor_total,
        ]);

        return $res;
    }
}
?>
