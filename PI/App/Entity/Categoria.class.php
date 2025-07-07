<?php


require_once(__DIR__ . '/../DB/Database.php');

class Categoria{
    public string $nome;
    public string $status_categoria;
    public string $imagem;

    public function cadastrarCategoria(){
        $db = new Database('categoria');
        $res = $db->insert(
            [
                'nome' => $this->nome,
                'status_categoria' => $this->status_categoria,
                'imagem' => $this->imagem
            ]
            );
            return $res;
    }

    public function atualizarCategoria($id_categoria){
        $db = new Database('categoria');
        $res = $db->update('id_categoria = '.$id_categoria, [
            'status_categoria' => $this->status_categoria,
            'nome' => $this->nome,
            'imagem' => $this->imagem,
        ]);
    
        return $res;
    }

    public static function SelectCategoriaPorId($where=null, $order =null, $limit = null){

        return (new Database('categoria'))->select('id_categoria = "'. $where .'"')->fetchObject(self::class);

    }

    public static function buscarCategoria($where=null, $order =null, $limit = null){
        return (new Database('categoria'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);

    }
    public static function buscarCategoriaLimit($where=null, $order =null, $limit = null){
        return (new Database('categoria'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);
        

    }

    
}