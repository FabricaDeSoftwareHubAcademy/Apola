<?php


require '../App/DB/Database.php';


class Cliente{


    public ?int $id_cliente;
    public ?string $nome;
    public  ?string $cep;
    public ?int $cpf;
    public ?string $email;
    public ?string $senha;
    private ?string $telefone = null;
    public int $num_casa;
    private ?string $rua = null;
    private ?string $bairro = null;
    private ?string $estado = null;
    private ?string $cidade = null;
    private ?string $complemento = null;


    public function __construct($nome = null, $cep = null, $cpf = null, $email = null, $senha = null) {
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->cep = $cep;
        $this->senha = $senha;
    }


    // Função que cadastra usúario no banco de dados 
    
    public function cadastrarCliente(){
        $db = new Database('cliente');

        $result = $db->insert(
            [
                'nome'=> $this->nome,
                'cep' => $this->cep,
                'cpf' => $this->cpf,
                'email' => $this->email,
                'senha' => $this->senha,
            ]
            );

        echo "erro"; 
    }


    
    // Função que lista dados da table de clientes do banco de dados

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



    public function atualizarCliente(){
        return (new Database('cliente'))->update('id = '.$this->id_cliente,[
                                            'nome'=> $this->nome,
                                            'cep' => $this->cep,
                                            'cpf' => $this->cpf,
                                            'email' => $this->email,
                                            'senha' => $this->senha,
        ]);
        
    }






}


// Debug
// echo "<prev>"; print_r(); echo "<prev>"; exit;