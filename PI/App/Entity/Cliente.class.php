<?php

require_once(__DIR__ . '/../DB/Database.php');

require_once 'User.php';

    


class Cliente extends User{


    public ?int $id_cliente = null;
    public string $nome;
    public string $sobrenome;
    public int $cpf;
    public ?string $telefone;
    public ?string $cep;
    public ?string $rua;
    public ?int $numero_casa;
    public ?string $bairro;
    public ?string $estado;
    public ?string $cidade;
    public int $id_usuario;
    public ?string $foto_perfil;


    //atributo tipo perfil
    // enum cliente e adm.

    // Função que cadastra usúario no banco de dados 
    
    public function cadastrarCliente(){


        $db = new Database('usuario');
        $res_id = $db->insert_LastId(
            [
                'nome' => $this->nome,
                'email' => $this->email,
                'senha' => $this->senha,
                'id_perfil' => $this->id_perfil
            ]
        );
        $db = new Database('cliente');
        $res = $db->insert(
            [
                'sobrenome' => $this->sobrenome,
                'cep' => $this->cep,
                'cpf' => $this->cpf,
                'id_usuario' => $res_id
            ]
            );

        
        return $res;
    }

    public static function getClienteById($id_cliente) {
        $db = new Database('cliente');
        $result = $db->select_perfil($id_cliente);
        return $result->fetch(PDO::FETCH_ASSOC); 
    }
    
    public static function getClienteByUsuarioId($id_usuario) {
        $db = new Database('cliente');
        $result = $db->select("id_usuario = $id_usuario");
        return $result->fetchObject(self::class);
    }


    
    public static function getCliente($where=null, $order =null, $limit = null){
        return (new Database('cliente'))->select($where,$order,$limit)
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);

    }

    // Função que retorna uma instâcia de usuario com base no email

    public static function getUsuarioPorEmail($where=null, $order =null, $limit = null){

        return (new Database('cliente'))->select('email = "'. $where .'"')->fetchObject(self::class);

    }


    // QUANDO EU QUERO RETORNAR UM OBJETO "CLASSE" PARA INSTANCIAR 
    // public static function getUsuarioPorEmail($where=null, $order =null, $limit = null){

    //     return (new Database('cliente'))->select('email = "'. $where .'"')->fetchObject(self::class);

    // }





    public function atualizarCliente() {
        // Atualizar tabela 'usuario'
        $db = new Database('usuario');
        $resUsuario = $db->update('id_usuario = ' . $this->id_usuario, [
            'nome' => $this->nome,
            'email' => $this->email,
            // senha se quiser atualizar
        ]);
    
        // Atualizar tabela 'cliente'
        $dbCliente = new Database('cliente');
        $resCliente = $dbCliente->update('id_cliente = ' . $this->id_cliente, [
            'sobrenome' => $this->sobrenome,
            'cep' => $this->cep,
            'foto_perfil' => $this->foto_perfil,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'numero_casa' => $this->numero_casa,
            'rua' => $this->rua,
            'bairro' => $this->bairro,
            'estado' => $this->estado,
            'cidade' => $this->cidade,
            
        ]);
    
        return ($resUsuario && $resCliente);
    }
    
}