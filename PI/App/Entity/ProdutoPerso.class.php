<?php
require_once(__DIR__ . '/../DB/Database.php');
require_once 'Pedido.class.php';

class ProdutoPerso extends Pedido{
    public string $tipo;
    public string $descricao;
    public array $imagens = [];


    public function cadastrarProdutoPerso(){
        $dbProduto = new Database('produto_perso');
        $res_id = $dbProduto->insert_LastId([
            'tipo' => $this->tipo, 
            'descricao' => $this->descricao 
        ]);
    
        if ($res_id) {
            // Inserir imagens
            $dbImagens = new Database('imagens_produto_perso');
            $imagensDB = [
                'imagem1' => $this->imagens[0] ?? null,
                'imagem2' => $this->imagens[1] ?? null,
                'imagem3' => $this->imagens[2] ?? null,
                'imagem4' => $this->imagens[3] ?? null,
                'id_produto_perso' => $res_id
            ];
            $resImagens = $dbImagens->insert($imagensDB);
    
            if (!$resImagens) {
                return false; // Falha ao inserir imagens
            }
    
            try{// Inserir pedido
                $dbPedido = new Database('pedido');
                $resPedido = $dbPedido->insert([
                    'data_pedido' => $this->data_pedido,
                    'tipo' => $this->tipo,
                    'status_pedido' => $this->status_pedido,
                    'codigo_rastreio' => $this->codigo_rastreio,
                    'produto_perso_id_produto_perso' => $res_id,
                    'id_cliente' =>$this->id_cliente
                ]);
        
                return $resPedido; // Retorna true se deu tudo certo
            }catch (Exception $e) {
                return $e;
            }
        }
    
        return false;
    }
}