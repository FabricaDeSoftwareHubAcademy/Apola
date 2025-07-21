<?php
include "nav_bar_adm.php";

$entityAdm = new Adm();
$adm = $entityAdm->getAdmById($id_administrador);
$id_usuario = $adm->id_usuario;

$entityUsuario = new User();
$usuario = $entityUsuario->getUsuarioById($id_usuario);
?>


<link rel="stylesheet" href="../../src/Css/favoritos_adm.css">
<link rel="stylesheet" href="../../src/Css/perfil_adm.css">

<main class="main2">
    <section class="container_perfil">
        <div class="left-container_favoritos">
            <div class="container_favoritos_left">
                <div class="title_left_favoritos">Meu Perfil</div>
                <ul>
                    <li class="item_favorito_left">
                        <i class="fa-solid icon_favorito_content fa-house"></i>
                        <a class="link_favorito_left" href="./perfil_adm.php">Conta</a>
                    </li>
                    <li class="item_favorito_left">
                        <i class="fa-solid fa-pencil icon_favorito_content"></i>
                        <a class="link_favorito_left" href="./alterar_perfil_adm.php">Alterar Perfil</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="right_container_perfil">
            <div class="container_right_perfil">
                <form method="POST" class="inputs_perfil" enctype="multipart/form-data">
                    <div class="container_banner_perfil">
                        <img src="../../src/imagens/cadastro/perfil/banner-perfil2.png" alt="" class="banner-img">
                        <div><input id="foto_perfil" name="foto_perfil" type="file"></div>
                        <div class="shape_perfil">
                        <?php if ($usuario->foto_perfil): ?>
                        <img src="../../src/imagens/cadastro/perfil/<?=$usuario->foto_perfil?>" alt="Foto de Perfil">
                        <?php else: ?>
                            <svg width="100" height="100" viewBox="0 0 24 24" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <?php endif; ?>

                        </div>
                    </div>

                    <div class="input_perfil_container">
                        <div class="input_item_perfil">
                            <label for="">Nome Completo</label>
                            <div class="container_edit_perfil">
                                <input disabled type="text" name="nome" value="<?= $usuario->nome; ?>">
                            </div>
                        </div>

                        <div class="input_item_perfil">
                            <label for="">Email</label>
                            <div class="container_edit_perfil">
                                <input disabled type="email" name="email" value="<?= $usuario->email; ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1'): ?>
    <dialog id="modal_sucesso" style="padding: 20px; border-radius: 10px; border: none;">
        <p style="font-size: 18px; color: green;">Perfil atualizado com sucesso!</p>
    </dialog>
    <script>
        const modal = document.getElementById('modal_sucesso');
        if (modal) {
            modal.showModal();
            setTimeout(() => {
                modal.close();
            }, 3000); // Fecha o modal em 3 segundos

            // Redireciona após o modal fechar
            setTimeout(() => {
                window.location.href = 'perfil_adm.php';
            }, 3100); // Espera 3.1s (um pouquinho a mais pra garantir que o modal fechou)
        }
    </script>
<?php endif; ?>

