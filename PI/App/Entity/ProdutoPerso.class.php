<?php
require_once(__DIR__ . '/../DB/Database.php');

class ProdutoPerso{
    public string $tipo;
    public string $descricao;
    public array $imagens = [];


    public function cadastrarProdutoPerso(){
        $db = new Database('produto_perso');
        $res_id = $db->insert_LastId([
            'tipo' => $this->tipo, 
            'descricao' => $this->descricao 
        ]);

        if($res_id){
            $db = new Database('imagens_produto_perso');
            $imagensDB = [
                'imagem1' => $this->imagens[0] ?? null,
                'imagem2' => $this->imagens[1] ?? null,
                'imagem3' => $this->imagens[2] ?? null,
                'imagem4' => $this->imagens[3] ?? null,
                'id_produto_perso' => $res_id
            ];
            $res = $db->insert($imagensDB);
    
            return $res;
        } 
    }
}