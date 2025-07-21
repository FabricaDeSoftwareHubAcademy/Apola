<?php

require '../../App/config.inc.php';
require '../../App/Session/Login.php';

include "head.php";

$result = Login::IsLogedCliente();
if($result){
    $id_cliente = $_SESSION['cliente']['id_cliente'];

    $objCliente = new Cliente();
    
    $cli = $objCliente->getClienteById($id_cliente);
}

if($result){
    include "navbar_logado.php";

    // $cliente = User::getUserPorEmail($result);
    // print_r($cliente);

}else{
    header('location: login.php');
}

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
                    <div><input id="foto_perfil" name="foto_perfil" type="file"></div>
                    <div class="shape_perfil">
                    <?php if ($cli['foto_perfil']): ?>
                        <img src="<?= $cli['foto_perfil'] ?>" alt="Foto de Perfil">
                    <?php else: ?>
                        <svg width="100" height="100" viewBox="0 0 24 24" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <?php endif; ?>
                    </div>
                </div>

                     
                    <form class="inputs_perfil">
                        <div class="input_perfil_container">
                            <div class="input_item_perfil">
                                <label for="">Nome</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="nome_user" id="" value="<?=$cli['nome'];?>">
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Sobrenome</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="nome" id="" value="<?=$cli['sobrenome'];?>">
                                   
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Email</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="email" name="email" id="" value="<?=$cli['email'];?>">
                                   
                                </div>
                            </div>
                            <div class="input_item_perfil">
                            <label for="">CPF</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="cpf" id=""  value="<?=$cli['cpf'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">CEP</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="cep" id=""  value="<?=$cli['cep'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">N°</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" class="input_esp_num" type="text" name="num_casa" id=""  value="<?=$cli['numero_casa'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Telefone</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" class="input_tel" type="tel" name="telefone" id=""  value="<?=$cli['telefone'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Rua</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="rua" id=""  value="<?=$cli['rua'];?>">
                              
                                </div>
                            </div>
                            
                            <div class="input_item_perfil">
                                <label for="">Bairro</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="bairro" id=""  value="<?=$cli['bairro'];?>">
                              
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Cidade</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="cidade" id=""  value="<?=$cli['cidade'];?>">
                              
                                </div>
                       
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Estado:</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" class="input_esp_num" type="text" name="num_casa" id="" value="<?=$cli['estado'];?>">
                                   
                                </div>
                            </div>
                            <!-- <div class="container_btn_perfil">
                                <button class="btn_cancelar">Cancelar</button>
                                <button class="btn_salvar">Salvar</button>
                            </div> -->

                        </div>

                    </form>

                </div>
                
            </div>
        </section>


    </main>
<?php

include "footer.php";

?>