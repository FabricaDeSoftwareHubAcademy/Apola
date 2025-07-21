<?php
include 'nav_bar_adm.php';

$entityAdm = new Adm();
$adm = $entityAdm->getAdmById($id_administrador);
$id_usuario = $adm->id_usuario;

$entityUsuario = new User();
$usuario = $entityUsuario->getUsuarioById($id_usuario);

if (isset($_POST['enviarDados'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $arquivo = $_FILES['foto_adm'];

    if ($arquivo['error'] == 0) {
        $pasta = '../../src/imagens/cadastro/perfil/';
        $nome_foto = $arquivo['name'];
        $novo_nome = uniqid();
        $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));
        if ($extensao != 'png' && $extensao != 'jpg' && $extensao != 'jpeg') die("Extensão inválida");

        $caminho = $pasta . $novo_nome . '.' . $extensao;
        move_uploaded_file($arquivo['tmp_name'], $caminho);
        $fotoPerfil = $novo_nome . '.' . $extensao;
    } else {
        $fotoPerfil = $adm->foto_perfil;
    }

    $senhaCript = password_hash($senha, PASSWORD_DEFAULT);

    $entityUsuario->id_user = $id_usuario;
    $entityUsuario->nome = $nome;
    $entityUsuario->email = $email;
    $entityUsuario->senha = $senhaCript;
    $entityUsuario->id_perfil = "adm";
    $entityUsuario->foto_perfil = $fotoPerfil;
    $resultadoUpdadeUser = $entityUsuario->updateUser();

    $entityAdm->id_administrador = $id_administrador;
    $entityAdm->id_usuario = $id_usuario;
    $entityAdm->nome = $nome;
    $entityAdm->email = $email;
    $entityAdm->senha = $senhaCript;
    $entityAdm->foto_perfil = $fotoPerfil;
    $resultadoUpdadeAdm = $entityAdm->updateAdm();

    if ($resultadoUpdadeAdm && $resultadoUpdadeUser) {
        $adm = $entityAdm->getAdmById($id_administrador);
        $usuario = $entityUsuario->getUsuarioById($id_usuario);
        $mostrarModal = true;
        echo '<meta http-equiv="refresh" content="1.9">';
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Não foi possível atualizar as informações.',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Perfil Adm</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="seu_arquivo_css.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

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
            <img src="../../src/imagens/cadastro/perfil/banner-perfil2.png" alt="Banner" class="banner-img">

            <label for="foto_adm" class="custom-upload">
              <i class="fas fa-camera"></i>
            </label>
            <input id="foto_adm" name="foto_adm" type="file">

            <div class="shape_perfil">
                        <?php if ($usuario->foto_perfil): ?>
                          <img id="preview_foto" src="../../src/imagens/cadastro/perfil/<?=$usuario->foto_perfil?>" alt="Foto de Perfil">
                          <?php else: ?>
                              <svg width="100" height="100" viewBox="0 0 24 24" fill="#ccc" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                          </svg>
                        <?php endif; ?>
            </div>
          </div>

          <div class="input_perfil_container">
            <div class="input_item_perfil">
              <label>Nome Completo</label>
              <div class="container_edit_perfil">
                <input type="text" name="nome" value="<?= $usuario->nome; ?>">
              </div>
            </div>

            <div class="input_item_perfil">
              <label>Email</label>
              <div class="container_edit_perfil">
                <input type="email" name="email" value="<?= $usuario->email; ?>">
              </div>
            </div>

            <div class="input_item_perfil">
              <label>Alterar Senha</label>
              <div class="container_edit_perfil">
                <input type="password" name="senha" placeholder="Insira a nova senha">
              </div>
            </div>

            <div class="container_btn_perfil">
              <button type="button" onclick="location.reload()" class="btn_cancelar">Cancelar</button>
              <button type="submit" name="enviarDados" class="btn_salvar">Salvar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>

<!-- Script para preview da imagem -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("foto_adm");
    const preview = document.getElementById("preview_foto");

    input.addEventListener("change", function () {
        const file = this.files[0];
        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>

<!-- Modal + SweetAlert se sucesso -->
<?php if (isset($mostrarModal) && $mostrarModal === true): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    window.onload = function () {
      Swal.fire({
        icon: 'success',
        title: 'Perfil atualizado com sucesso!',
        showConfirmButton: false,
        timer: 1000
      });

      // Redireciona após 1 segundo (mesmo tempo do timer do modal)
      setTimeout(function () {
        window.location.href = 'perfil_adm.php';
      }, 1000);
    };
  </script>
<?php endif; ?>

</body>
</html>
