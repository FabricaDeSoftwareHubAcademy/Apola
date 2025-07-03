<?php

include "nav_bar_adm.php";   

// $id_adm = ($sessao);
// print_r($id_administrador);

$entityAdm = new Adm();
$adm = $entityAdm->getAdmById($id_administrador);
$id_usuario = $adm->id_usuario;
$entityUsuario = new User();

$usuario = $entityUsuario->getUsuarioById($id_usuario);

$lourdes = $entityUsuario->getUsuarioById($id_usuario)



?>
<link rel="stylesheet" href="../../src/Css/favoritos_adm.css">    
<link rel="stylesheet" href="../../src/Css/perfil_adm.css">    
 <main  class="main2">
        <section class="container_perfil">
            <div class="left-container_favoritos">
                <div class="container_favoritos_left">
                    <div class="title_left_favoritos">Meu Perfil</div>
                    <ul>
                        <li class="item_favorito_left">
                            <i class="fa-solid icon_favorito_content  fa-house"></i><a class="link_favorito_left" href="./perfil_adm.php">Conta</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid fa-pencil icon_favorito_content"></i><a class="link_favorito_left" href="./alterar_perfil_adm.php">Alterar Perfil</a>
                        </li>
                    </ul>


                </div>
            </div>
            <div class="right_container_perfil">
                <div class="container_right_perfil">
                    <div class="container_banner_perfil">
                        <img src="" alt="">
                        <div class="shape_perfil">
                            <img src="../../src/imagens/image.png" alt="">
                        </div>
                    </div>
                    <form class="inputs_perfil">
                        <div class="input_perfil_container">
                            <div class="input_item_perfil">
                                <label for="">Nome Completo</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="nome" id="" value="<?=$usuario->nome; ?>">
                                   
                                </div>
                            </div>
                            <div class="input_item_perfil">
                                <label for="">Email</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="email" name="email" id="" value="<?= $usuario->email; ?>">
                                   
                                </div>
                            </div>
                            <!-- <div class="input_item_perfil">
                                <label for="">Senha</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="senha" name="senha" id="">
                              
                                </div>
                            </div> -->
                            
                            <!-- <div class="input_item_perfil">
                                <label for="">CPF</label>
                                <div class="container_edit_perfil">
                                    <input disabled="" type="text" name="cpf" id="">
                              
                                </div>
                            </div> -->
                            <!-- <div class="container_btn_perfil">
                                <button class="btn_cancelar">Cancelar</button>
                                <button class="btn_salvar">Salvar</button>
                            </div> -->

                        </div>

                    </form>

                </div>
                
            </div>
        </section>

<!-- Tarefa Lourdes: Criar modal verdinho de correto na tela de perfil do adm - Taslk 41  -->

    </main>

<?php

if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1'): ?>
  <dialog id="modal_sucesso" style="padding: 20px; border-radius: 10px; border: none;">
    <p style="font-size: 18px; color: green;">Perfil atualizado com sucesso!</p>
  </dialog>
  <script>
    const modal = document.getElementById('modal_sucesso');
    if (modal) {
      modal.showModal();
      setTimeout(() => {
        modal.close();
      }, 3000); // fecha após 3 segundos
    }
  </script>
<?php endif; ?>

<?php
// include "footer.php";
?>


