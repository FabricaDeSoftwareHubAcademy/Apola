<?php
require_once(__DIR__ . '/../DB/Database.php');

use App\DB\Database;

class Produto{
    public string $nome;
    public float $preco;
    public ?string $avaliacao;
    public int $quantidade;
    public string $cor;
    public float $largura;
    public float $altura;
    public string $imagem;
    public string $descricao;
    public string $tipo;
    public string $status_produto;
    public int $categoria_id_categoria;

    public function cadastrarProduto(){
        $db = new Database('produto');
        $result = $db->insert(
            [
                'nome' => $this->nome,
                'preco' => $this->preco,
                'avaliacao' => $this->avaliacao,
                'quantidade' => $this->quantidade,
                'cor' => $this->cor,
                'largura' => $this->largura,
                'altura' => $this->altura,
                'imagem' => $this->imagem,
                'descricao' => $this->descricao,
                'tipo' => $this->tipo,
                'status_produto' => $this->status_produto,
                'categoria_id_categoria' => $this->categoria_id_categoria
            ]
        );

        return $result;
    }

    public function atualizarProduto($id_produto){
        $db = new Database('produto');
        $res = $db->update('id_produto = '.$id_produto, [
            'nome' => $this->nome,
            'preco' => $this->preco,
            'avaliacao' => $this->avaliacao,
            'quantidade' => $this->quantidade,
            'cor' => $this->cor,
            'largura' => $this->largura,
            'altura' => $this->altura,
            'imagem' => $this->imagem,
            'descricao' => $this->descricao,
            'tipo' => $this->tipo,
            'status_produto' => $this->status_produto,
            'categoria_id_categoria' => $this->categoria_id_categoria
        ]);
    
        return $res;
    }

    public static function buscarProdutoPorId($where=null, $order =null, $limit = null){
        return (new Database('produto'))->select('id_produto = "'. $where .'"')->fetchObject(self::class);

    }

    public static function buscarProduto($where=null, $order =null, $limit = null){
        // print_r($where);
        return (new Database('produto'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);

    }


    public static function buscarProdutoCategoria($categoria){

        return (new Database('produto'))->select_produto_por_categoria($categoria);

    
    }
    
    public static function buscarProdutoAleatorio(){

        return (new Database('produto'))->select_produto_por_aleatorio();

    
    }


    
}