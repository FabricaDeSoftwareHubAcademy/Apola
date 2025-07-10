<?php

require '../../App/config.inc.php';
require '../../App/Session/Login.php';
include "head.php";

$result = Login::IsLogedCliente();

if (!$result) {
    header('location: login.php');
    exit;
}

$id_cliente = $_SESSION['cliente']['id_cliente'];

$objCliente = new Cliente();

$cli = $objCliente->getClienteById($id_cliente);

if (!$cli) {
    die("Cliente não encontrado.");
}

include "navbar_logado.php";

if (isset($_POST['carregarNovosDados'])) {

    // Sanitize inputs (exemplo simples)
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
    $num_casa = filter_input(INPUT_POST, 'num_casa', FILTER_VALIDATE_INT);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email === false) {
        die("Email inválido.");
    }

    $arquivo = $_FILES['foto_perfil'];

    $caminho = $cli['foto_perfil']; // mantém foto atual caso não envie nova

    if ($arquivo && $arquivo['error'] === UPLOAD_ERR_OK) {
        $pasta = '../../src/imagens/cadastro/perfil/';
        $nome_foto = $arquivo['name'];
        $novo_nome = uniqid();
        $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));

        if (!in_array($extensao, ['png', 'jpg', 'jpeg'])) {
            die("Extensão da foto inválida. Apenas png, jpg e jpeg são permitidos.");
        }

        $caminho = $pasta . $novo_nome . '.' . $extensao;

        if (!move_uploaded_file($arquivo['tmp_name'], $caminho)) {
            die("Falha ao enviar a foto.");
        }
    }
    // Caso tenha enviado arquivo mas deu erro:
    elseif ($arquivo && $arquivo['error'] !== UPLOAD_ERR_NO_FILE) {
        die("Erro ao enviar a foto.");
    }

    $cliente = new Cliente();

    $cliente->id_cliente = $id_cliente;
    $cliente->nome = $nome;
    $cliente->sobrenome = $sobrenome;
    $cliente->cpf = $cpf;
    $cliente->cep = $cep;
    $cliente->telefone = $telefone;
    $cliente->numero_casa = $num_casa ?: 0; // evita null
    $cliente->foto_perfil = $caminho;
    $cliente->rua = $rua;
    $cliente->bairro = $bairro;
    $cliente->estado = $estado;
    $cliente->cidade = $cidade;
    $cliente->email = $email;
    $cliente->id_usuario = $cli['id_usuario'];

    $resultado = $cliente->atualizarCliente();

    if ($resultado) {
        echo '<script>
                alert("Atualizado com sucesso!!");
                window.location.href = "./perfil.php";
              </script>';
    } else {
        echo '<script>
                alert("Erro ao atualizar!");
              </script>';
    }
}

?>




?>
<link rel="stylesheet" href="../../src/Css/perfil.css">
    <main  class="main2">
        <section class="container_perfil">
            <div class="left-container_favoritos">
                <div class="container_favoritos_left">
                    <div class="title_left_favoritos">Meu Perfil</div>
                    <ul>
                        <li class="item_favorito_left">
                            <i class="fa-solid icon_favorito_content  fa-house"></i><a class="link_favorito_left" href="./perfil.php">Conta</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid icon_favorito_content fa-heart"></i><a class="link_favorito_left" href="./Favoritos.php">Favoritos</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid  icon_favorito_content fa-boxes-stacked"></i><a class="link_favorito_left" href="./historico_pedido.php">Histórico de Pedidos</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid fa-pencil icon_favorito_content"></i><a class="link_favorito_left" href="./alterar_perfil.php">Alterar Perfil</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid fa-right-from-bracket"></i><a class="link_favorito_left" href="logout.php">Sair</a>
                        </li>
                    </ul>


                </div>
            </div>
            <div class="right_container_perfil">
                <div class="container_right_perfil">
                    
                <form method="POST" class="inputs_perfil"  enctype="multipart/form-data">

                    <div class="container_banner_perfil">
                        <img src="../../src/imagens/cadastro/perfil/banner-perfil2.png" alt="" class="banner-img">
                        <label for="foto_perfil" class="custom-upload">
                            <span>+</span>
                        </label>
                        <div> <input id="foto_perfil" name="foto_perfil" type="file"> </div>
                            <div class="shape_perfil">
                            <?php if ($cli['foto_perfil']): ?>
                                <img src="<?= $cli['foto_perfil'] ?>" alt="Foto de Perfil">
                                <?php else: ?>
                                    <svg width="100" height="100" viewBox="0 0 24 24" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/> </svg>
                                         <?php endif; ?>
                            </div>

                        </div>

                     
                        <div class="input_perfil_container">
                            <div class="input_item_perfil">
                                <label for="">Nome</label>
                                <div class="container_edit_perfil">
                                    <input type="text" name="nome" id="" value="<?=$cli['nome'];?>">
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Sobrenome</label>
                                <div class="container_edit_perfil">
                                    <input type="text" name="sobrenome" id="" value="<?=$cli['sobrenome'];?>">
                                   
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Email</label>
                                <div class="container_edit_perfil">
                                    <input type="email" name="email" id="" value="<?=$cli['email'];?>">
                                   
                                </div>
                            </div>
                            <div class="input_item_perfil">
                            <label for="">CPF</label>
                                <div class="container_edit_perfil">
                                    <input type="text" name="cpf" id=""  value="<?=$cli['cpf'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">CEP</label>
                                <div class="container_edit_perfil">
                                    <input  type="text" name="cep" id=""  value="<?=$cli['cep'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">N°</label>
                                <div class="container_edit_perfil">
                                    <input class="input_esp_num" type="text" name="num_casa" id=""  value="<?=$cli['numero_casa'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Telefone</label>
                                <div class="container_edit_perfil">
                                    <input type="tel" class="input_tel" name="telefone" id=""  value="<?=$cli['telefone'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Rua</label>
                                <div class="container_edit_perfil">
                                    <input type="text" name="rua" id=""  value="<?=$cli['rua'];?>">
                              
                                </div>
                            </div>
                            
                            <div class="input_item_perfil">
                                <label for="">Bairro</label>
                                <div class="container_edit_perfil">
                                    <input type="text" name="bairro" id=""  value="<?=$cli['bairro'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Cidade</label>
                                <div class="container_edit_perfil">
                                    <input type="text" name="cidade" id=""  value="<?=$cli['cidade'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Estado:</label>
                                <div class="container_edit_perfil">
                                    <input class="input_esp_num" name="estado" type="text" value="<?=$cli['estado'];?>">
                                </div>
                            </div>
                            <div class="container_btn_perfil">
                                <button class="btn_cancelar">Cancelar</button>
                                <button type="submit" name="carregarNovosDados" class="btn_salvar">Salvar</button>
                            </div>

                        </div>

                    </form>

                </div>
                
            </div>
        </section>


    </main>
<?php

include "footer.php";
?>