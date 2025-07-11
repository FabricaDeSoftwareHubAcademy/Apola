<?php


require '../../App/config.inc.php';

require '../../App/Session/Login.php';

include 'head.php';


$erro = '';
$succes ='';

if(isset($_POST['cadastrar'])){


    if(!empty($_POST['email']) || !empty($_POST['senha']) || !empty($_POST['cpf']) || !empty($_POST['cep']) || !empty($_POST['nome']) || !empty($_POST['sobrenome'])){

        $nome  = $_POST['nome'];
        $sobrenome  = $_POST['sobrenome'];
        $email  = $_POST['email'];
        $senha  = $_POST['senha'];
        $cpf  = $_POST['cpf'];
        $cep  = $_POST['cep'];

                $cliente =  new Cliente();

                $cliente->nome = $nome;
                $cliente->sobrenome = $sobrenome;
                $cliente->cep = $cep;
                $cliente->cpf =$cpf;
                $cliente->email =$email;
                $cliente->senha = password_hash($senha, PASSWORD_DEFAULT);
                $cliente->id_perfil = "cli";



                $cliente->cadastrarCliente();

                if($cliente){
                    $succes='Cadastro realizado com sucesso';
                }else{
                    $erro='Erro ao cadastrar';
                }
    };
}




?> 


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="stylesheet" href="../../src/Css/style.css">
</head>
<body class="body-cad" >
    <main class ="main3">
        <header style="  position:unset; z-index: unset;  border-bottom: unset;" class="menu">
            <nav class="container-menu">
                    <div class="img-menu">
                        <a href="./Home.php">
                            <img src="../../src/imagens/Apola__1_-removebg-preview.png" alt=""class="img-logo" >
                        </a>
                    </div>
            </nav>
        </header>
        <section class="cadastro">
            <div class="content-cadastro">
                <div class="shape"></div>
                <div class="shape-2"></div>
                <div class="container-cadastro">
                    <div class="form-cadastro">
                        <div class="text-cadastro">Cadastro</div>
                        <form method='post'>
                            <div class="form__group field">
                                <input autocomplete="off" type="text" name="nome" class="form__field" placeholder="Nome" id="nome-cad" required>
                                <label for="nome-cad" class="form__label">Nome</label>
                                <div class="erro-input" id="erro-nome"></div>
                            </div>

                            <div class="form__group field">
                                <input autocomplete="off" type="text" name="sobrenome" class="form__field" placeholder="Sobrenome" id="sobrenome-cad" required>
                                <label for="sobrenome-cad" class="form__label">Sobrenome</label>
                                <div class="erro-input" id="erro-sobrenome"></div>
                            </div>

                            <div class="form__group field">
                                <input autocomplete="off" type="text" name="email" id="email-cad" class="form__field" placeholder="E-mail" required>
                                <label for="email-cad" class="form__label">E-mail*</label>
                                <div class="erro-input" id="erro-email"></div>
                            </div>

                            <div class="form__group field">
                                <input maxlength="11" autocomplete="off" type="text" name="cpf" id="cpf-cad" class="form__field" placeholder="CPF" required>
                                <label for="cpf-cad" class="form__label">CPF*</label>
                                <div class="erro-input" id="erro-cpf"></div>
                            </div>

                            <div class="form__group field">
                                <input  maxlength="8" autocomplete="off" type="text" name="cep" id="cep-cad" class="form__field" placeholder="CEP" required>
                                <label for="cep-cad" class="form__label">CEP*</label>
                                <div class="erro-input" id="erro-cep"></div>
                            </div>

                            <div class="form__group field">
                                <input autocomplete="off" type="password" name="senha" id="senha-cad" class="form__field" placeholder="Senha" required>
                                <label for="senha-cad" class="form__label">Senha*</label>
                                <div class="erro-input" id="erro-senha"></div>
                            </div>

                            <span class='msg_erro'><?php echo $erro; ?></span>
                            <span id="spanCadastrado" class='msg_sucesso'><?php echo $succes; ?></span>

                            <div class="btn-cadastro">
                                <button name="cadastrar">Cadastra-se</button>
                            </div>
                            <span class="span-cadastro">Já possui conta? <a href="./login.php">Faça login</a></span>
                        </form>
                    </div>
                </div>
                <div class="img-container-cadastro">
                    <img src="../../src/imagens/cadastro/mulher-plana-cuidando-de-plantas.png" alt="">
                </div>
            </div>
            <div id="ModalCadastro" class="modalCadastro">
                <div class="areaBtnFecharModalCadastro">
                    <p id="fecharModalCadastro">X</p>
                </div>
                <div class="conteudoModalCadastro">
                    <h1>Cadastrado com Sucesso!!!</h1>
                    <p><a href="./login.php">Logar</a></p>
                </div>
            </div>
        </section>
        <script src="../../src/JS/validacao_cadastro.js"></script>
    </main>
</body>
</html>