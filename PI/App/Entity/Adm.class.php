<?php


require_once 'User.php';
require_once(__DIR__ . '/../DB/Database.php');

use App\DB\Database;


class Adm extends User{

    public int $id_usuario;

    public function cadastrarAdm(){


        $db = new Database('usuario');
        $res_id = $db->insert_LastId(
            [
                'nome' => $this->nome,
                'email' => $this->email,
                'senha' => $this->senha,
                'id_perfil' => $this->id_perfil
            ]
        );
        $db = new Database('administrador');
        $res = $db->insert(
            [
                'id_usuario' => $res_id
            ]
            );

        
        return $res;
    }

    public static function getAdmByUsuarioId($id_usuario) {
        $db = new Database('administrador');
        $result = $db->select("id_usuario = $id_usuario");
        return $result->fetchObject(self::class);
    }

    public static function getAdm($where=null, $order =null, $limit = null){
        return (new Database('administrador'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);

    }

    public static function getAdmById($id_adm) {
        $db = new Database('administrador');
        $result = $db->select("id_administrador = $id_adm");
        return $result->fetchObject(self::class);
    }

    public function updateAdm($id_administador){
        return (new Database('administrador'))->update('id_administrador = '.$id_administador,[
                                            'id_usuario'=> $this->id_usuario,
        ]);
        
    }
}


