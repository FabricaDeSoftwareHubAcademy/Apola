<?php


require_once(__DIR__ . '/../DB/Database.php');




class User{


    public int $id_user;
    public string $nome;
    public string $email;
    public string $senha;
    public string $id_perfil;



    



    // Função que cadastra usúario no banco de dados 
    
    public function cadastrarUser(){
        $db = new Database('user');

        $result = $db->insert(
            [
                'nome'=> $this->nome,
                'email'=> $this->email,
                'senha' => $this->senha,
                'id_perfil' => $this->id_perfil,
            ]
            );
        return $result;
    }


    
    // Função que lista dados da table de clientes do banco de dados
    public static function getUsuarioByEmail($email) {
        $db = new Database('usuario');
        $result = $db->select("email = '$email'");
        return $result->fetchObject(self::class); 
    }

    public static function getUsuarioById($id_usuario) {
        $db = new Database('usuario');
        $result = $db->select("id_usuario = '$id_usuario'");
        return $result->fetchObject(self::class); 
    }

    public static function getUser($where=null, $order =null, $limit = null){
        return (new Database('user'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);

    }

    // Função que retorna uma instâcia de usuario com base no email


    // QUANDO EU QUERO RETORNAR UM OBJETO "CLASSE" PARA INSTANCIAR 
    // public static function getUsuarioPorEmail($where=null, $order =null, $limit = null){

    //     return (new Database('cliente'))->select('email = "'. $where .'"')->fetchObject(self::class);

    // }



    public function updateUser(){
        return (new Database('usuario'))->update('id_usuario = '.$this->id_user,[
                                            'nome'=> $this->nome,
                                            'email' => $this->email,
                                            'senha' => $this->senha,
                                            'id_perfil' => $this->id_perfil,
        ]);
        
    }

}

