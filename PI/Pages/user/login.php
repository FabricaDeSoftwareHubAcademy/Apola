<?php
require '../../App/config.inc.php';

require_once '../../App/Entity/User.php';
require_once '../../App/Entity/Cliente.class.php';
require_once '../../App/Entity/Adm.class.php';

require '../../App/Session/Login.php';

// Login::RequireLogout();

session_start();

$erro = '';
$succes = '';


if (isset($_POST['logar'])) {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = 'Email não é válido';
        } else {
            $usuario = User::getUsuarioByEmail($email);
            // print_r($usuario);

            if ($usuario) {
                $idUsuario = $usuario->id_usuario;
                if ($usuario->id_perfil == 'adm' && $senha == 'adm') {
                    $adm = Adm::getAdmByUsuarioId($idUsuario);
                    if ($adm) {
                        $adm->id_usuario = $idUsuario;
                        $adm->email = $usuario->email;
                        Login::loginAdm($adm);
                        exit;
                    }
                }
                // Verificação padrão com senha criptografada
                if (password_verify($senha, $usuario->senha)) {
                    // Verificar se é cliente
                    $cliente = Cliente::getClienteByUsuarioId($idUsuario);
                    if ($cliente) {
                        $cliente->nome = $usuario->nome;
                        $cliente->email = $usuario->email;
                        Login::loginCLiente($cliente);
                        echo '<script>alert("Login bem-sucedido!")</script>';
                        exit;
                    }

                    // Verificar se é admin com senha já atualizada
                    if ($usuario->id_perfil == 'adm') {
                        $adm = Adm::getAdmByUsuarioId($idUsuario);
                        if ($adm) {
                            $adm->id_usuario = $usuario->id_usuario;
                            $_SESSION["id_usuario"] = $idUsuario;
                            Login::loginAdm($adm);
                            exit;
                        }
                    }

                    $erro = 'Usuário não possui perfil (adm ou cliente).';
                } else {
                    $erro = 'Email ou senha incorretos.';
                }
            } else {
                $erro = 'Usuário não encontrado.';

            }
        }
    } else {
        $erro = 'Preencha todos os campos.';
    }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/Css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="../JS/validar_form_login.js" defer></script> -->

    <title>Login</title>
</head> 
<body class="body-log">
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
        <section class="login">
            <div class="content-login">
                <div class="shape-login"></div>
                <div class="shape-login2"></div>
                <div class="img-container-login">
                    <img src="../../src/imagens/login/Knitting-amico.png" alt="">
                </div>
                <div class="container-login">
                    <div class="form-container">
                        <div class="text-login">Login</div>
                        <form action="login.php" method="post">
                            <div class="form__group field">
                                <input type="text" name='email' id="email-login" class="form__field" placeholder="E-mail" required>
                                <label for="email" class="form__label">E-mail*</label>
                            </div>
                            <div class="form__group field">
                                <input type="password" name='senha' id="senha-login"  class="form__field" placeholder="Senha" required>
                                <label for="senha" class="form__label">Senha*</label>
                            </div>
                            <div class="remenber">
                                <label for="">
                                    <input type="checkbox"> Lembre-me
                                </label>
                                <p class="open-modal" data-modal="modal-1"><a href="#">Esqueceu a senha?</a></p>
                                <!-- MODAL QUE APÓS CLICAR EM RECUPERAR A SENHA É REDIRECIONADO PARA CONFIRMAR EMAIL PARA RECUPERAÇÃO DA SENHA -->
                                <dialog id="modal-1">
                                <div class="modal_header">
                                    <button class="close-modal" data-modal="modal-1"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class="modal_body">
                                    <h5 class="title_modal_zap">Redefinição de Senha!</h5>
                                    <div class="text_modal_zap">     um e-mail para recuperar a senha.</div>
                                    <div class="form_modal" action="">
                                        <label class="label_modal" for="">Email</label>
                                        <input class="input_modal" type="email" name="" id="">
                                        <div class="container_btn_modal_email">
                                            <button class="btn_enviar_modal_email">Enviar</button>
                                        </div>
                                    </div>
                                </div>
                                </dialog>
                                <script src="../../src/JS/modal.js"></script>
                            </div>
                            <span class='msg_erro'><?php echo $erro; ?></span>
                            <span class='msg_sucesso'><?php echo $succes; ?></span>
                            <div class="btn-login">
                            <button id="botao-login" name="logar" type="submit">Entrar</button>

                            </div>
                            <p id="msnErro-login" class="msnErro-login"></p>
                            <span class="span-login">Novo na Apola?<a href="./cadastro.php">Cadastra-se</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </section>
            
    </main>
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input');
    const botaoLogin = document.getElementById('botao-login');

    inputs.forEach(input => {
      input.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
          event.preventDefault(); // impede comportamento padrão
          botaoLogin.click(); // simula clique no botão de login
        }
      });
    });
  });
</script>

    
</body>
</html>