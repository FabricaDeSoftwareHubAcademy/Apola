<?php
include 'nav_bar_adm.php';
$banner = new Banner();

$bannerPrincipalPosicao1 = $banner->getBannerForPosicao('banners_principais',1);
$bannerPrincipalPosicao2 = $banner->getBannerForPosicao('banners_principais',2);
$bannerPrincipalPosicao3 = $banner->getBannerForPosicao('banners_principais',3);

$bannerSecundarioPosicao1 = $banner->getBannerForPosicao('banners_secundarios',1);
$bannerPromocionalPosicao1  = $banner->getBannerForPosicao('banners_promocionais',1);
$bannerPromocionalPosicao2  = $banner->getBannerForPosicao('banners_promocionais',2);
$bannerPromocionalPosicao3  = $banner->getBannerForPosicao('banners_promocionais',3);

$bannerMobilePosicao1 = $banner->getBannerForPosicao('banners_mobile',1);
$bannerMobilePosicao2 = $banner->getBannerForPosicao('banners_mobile',2);
$bannerMobilePosicao3 = $banner->getBannerForPosicao('banners_mobile',3);
// print_r($bannerMobilePosicao1->caminho);
// print_r($bannerMobilePosicao2);
// print_r($bannerMobilePosicao3);

if (isset($_POST['cadastrarPrincipal'])) {

    $pastaDestino = '../../src/imagens/banner/bannerCadastrado/bannersPrincipais/';
    $extensoesPermitidas = ['png', 'jpg', 'jpeg','jfif'];
    $nomesInputs = ['bannerPrincipal1', 'bannerPrincipal2', 'bannerPrincipal3'];

    $bannerProcessado = false; // variável para controlar o modal

    foreach ($nomesInputs as $index => $inputName) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $arquivo = $_FILES[$inputName];
            $nomeOriginal = $arquivo['name'];
            $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

            if (!in_array($extensao, $extensoesPermitidas)) {
                echo "<script>alert('O arquivo \"$nomeOriginal\"  não é PNG, JPG e nem jfif.')</script>";
                echo '<meta http-equiv="refresh" content="0.8;">';
                exit;
            }

            $novoNome = uniqid('banner_', true) . '.' . $extensao;
            $caminhoFinal = $pastaDestino . $novoNome;

            if (!move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {
                die("Falha ao mover o arquivo: $nomeOriginal");
            }

            $posicao = $index + 1;

            $banner = new Banner();
            $banner->caminho = $caminhoFinal;
            $banner->posicao = $posicao;

            $bannerExistente = $banner->getBannerForPosicao('banners_principais', $posicao);

            if ($bannerExistente) {
                // Atualiza se já existe na posição
                $banner->updateBannersPrincipais();
            } else {
                // Cadastra se ainda não tem banner naquela posição
                $banner->cadastrarBannersPrincipais();
            }

            $bannerProcessado = true; // marca que processou ao menos um banner
        }
    }

    if ($bannerProcessado) {
        $mostrarModal = true; // ativa o modal verdinho
        echo '<meta http-equiv="refresh" content="1.9">';
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Nenhum arquivo foi enviado ou atualizado.',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
}

if (isset($_POST['cadastrarSecundario'])) {
    $pastaDestino = '../../src/imagens/banner/bannerCadastrado/bannersSecundarios/';
    $extensoesPermitidas = ['png', 'jpg', 'jpeg','jfif'];
    $nomesInputs = ['bannerSecundario'];

    $bannerProcessado = false;

    foreach ($nomesInputs as $index => $inputName) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $arquivo = $_FILES[$inputName];
            $nomeOriginal = $arquivo['name'];
            $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

            if (!in_array($extensao, $extensoesPermitidas)) {
                echo "<script>alert('O arquivo \"$nomeOriginal\" não é PNG, JPG e nem jfif.')</script>";
                echo '<meta http-equiv="refresh" content="0.8;">';
                exit;
            }

            $novoNome = uniqid('banner_', true) . '.' . $extensao;
            $caminhoFinal = $pastaDestino . $novoNome;

            if (!move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {
                die("Falha ao mover o arquivo: $nomeOriginal");
            }

            $posicao = 1;

            $banner = new Banner();
            $banner->caminho = $caminhoFinal;
            $banner->posicao = $posicao;

            $bannerExistente = $banner->getBannerForPosicao('banners_secundarios', $posicao);

            if ($bannerExistente) {
                // Atualiza se já existe na posição
                $banner->updateBannersSecundarios();
            } else {
                // Cadastra se ainda não tem banner naquela posição
                $banner->cadastrarBannersSecundarios();
            }

            $bannerProcessado = true;
        }
    }

    if ($bannerProcessado) {
        $mostrarModal = true; // ativa o modal verdinho
        echo '<meta http-equiv="refresh" content="1.9">';
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Nenhum arquivo foi enviado ou atualizado.',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
}

if (isset($_POST['cadastrarPromocionais'])) {
    $pastaDestino = '../../src/imagens/banner/bannerCadastrado/bannersPromocionais/';
    $extensoesPermitidas = ['png', 'jpg', 'jpeg','jfif'];
    $nomesInputs = ['bannerPromocional1','bannerPromocional2','bannerPromocional3'];

    $bannerProcessado = false;

    foreach ($nomesInputs as $index => $inputName) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $arquivo = $_FILES[$inputName];
            $nomeOriginal = $arquivo['name'];
            $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

            if (!in_array($extensao, $extensoesPermitidas)) {
                echo "<script>alert('O arquivo \"$nomeOriginal\" não é PNG, JPG e nem jfif.')</script>";
                echo '<meta http-equiv="refresh" content="0.8;">';
                exit;
            }

            $novoNome = uniqid('banner_', true) . '.' . $extensao;
            $caminhoFinal = $pastaDestino . $novoNome;

            if (!move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {
                die("Falha ao mover o arquivo: $nomeOriginal");
            }

            $posicao = $index + 1;

            $banner = new Banner();
            $banner->caminho = $caminhoFinal;
            $banner->posicao = $posicao;

            $bannerExistente = $banner->getBannerForPosicao('banners_promocionais', $posicao);

            if ($bannerExistente) {
                // Atualiza se já existe na posição
                $banner->updateBannersPromocionais();
            } else {
                // Cadastra se ainda não tem banner naquela posição
                $banner->cadastrarBannersPromocionais();
            }

            $bannerProcessado = true;
        }
    }

    if ($bannerProcessado) {
        $mostrarModal = true; // ativa o modal verdinho
        echo '<meta http-equiv="refresh" content="1.9">';
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Nenhum arquivo foi enviado ou atualizado.',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
}


if (isset($_POST['cadastrarMobile'])) {
    $pastaDestino = '../../src/imagens/banner/bannerCadastrado/bannersMobile/';
    $extensoesPermitidas = ['png', 'jpg', 'jpeg','jfif'];
    $nomesInputs = ['bannerMobile1','bannerMobile2','bannerMobile3'];
    
    foreach ($nomesInputs as $index => $inputName) {
        
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            
            $arquivo = $_FILES[$inputName];
            $nomeOriginal = $arquivo['name'];
            $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

            if (!in_array($extensao, $extensoesPermitidas)) {
                echo "<script>alert('O arquivo \"$nomeOriginal\" não é PNG, JPG e nem jfif.')</script>";
                echo '<meta http-equiv="refresh" content="0.8;">';
                exit;
            }

            $novoNome = uniqid('banner_', true) . '.' . $extensao;
            $caminhoFinal = $pastaDestino . $novoNome;
            
            if (!move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {
                die("Falha ao mover o arquivo: $nomeOriginal");
            }
            
            $posicao = $index + 1;
            
            $banner = new Banner();
            $banner->caminho = $caminhoFinal;
            $banner->posicao = $posicao;

            $bannerExistente = $banner->getBannerForPosicao('banners_mobile', $posicao);
           
            if ($bannerExistente) {
                // Atualiza se já existe na posição
                $banner->updateBannersMobile();
            } else {
                // Cadastra se ainda não tem banner naquela posição
                $banner->cadastrarBannersMobile();
            }

        } else {
            // echo "<script>alert('Erro ao processar o arquivo \"$inputName\".')</script>";
        }
    }

    if($banner){
        $mostrarModal = true; // ativa o modal verdinho
        if($mostrarModal == true){
            echo '<meta http-equiv="refresh" content="1.9">'; //
        } 
    
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

    <main class="main_adm">
        <div class="conatiner_dashbord_adm">
            <div class="Title_deafult_adm">
                <div class="container_title_adm_left">
                    <span class="title_adm">Cadastrar Banners</span>
                </div>
                <div class="container_title_adm_right">
                </div>
                
            </div>
           <div class="conatiner_cadastro_adm_items">
                <div class="top_container_cadastrar_produto_adm">
                    <!-- Banners Principais -->
                    <form method="POST" class="item_top_produto" enctype="multipart/form-data">
                        <h4 class="title_banner_categoria" >Banners Principais</h4>
                        <div class="tamanho_banner_adm">Tamanho recomendável (1400x400px)</div>
                        <div class="container_banner_wrap" id="banner-principal">
                            <div class="banner-item">
                                <img src= "<?=$bannerPrincipalPosicao1->caminho?> "alt="Imagem 1" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"> <i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input name="bannerPrincipal1" type="file" class="file-upload" accept="image/*" style="display:none;">
                            </div>
                            <div class="banner-item">
                                <img src= "<?=$bannerPrincipalPosicao2->caminho?> "alt="Imagem 2" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input name="bannerPrincipal2" type="file" class="file-upload" accept="image/*" style="display:none;">
                            </div>
                            <div class="banner-item">
                                <img src= "<?=$bannerPrincipalPosicao3->caminho?> "alt="Imagem 3" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"> <i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input name="bannerPrincipal3" type="file" class="file-upload" accept="image/*" style="display:none;">
                            </div>
                        </div>
                        <div class="conatiner_btn_adm ">
                            <button type="submit" name="cadastrarPrincipal" class="btn_salvar_adm">Salvar</button>
                        </div>
                    </form> 

                    <!-- Banners Secundários-->

                    <form method="POST" enctype="multipart/form-data" class="item_top_produto">
                        <h4 class="title_banner_categoria">Banners Secundários</h4>
                        <div class="tamanho_banner_adm">Tamanho recomendável (1700x700px)</div>
                        <div class="container_banner_wrap" id="banner-secundario">
                            <div class="banner-item">
                                <img src="<?=$bannerSecundarioPosicao1->caminho?>" alt="Imagem 1" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input name="bannerSecundario" type="file" class="file-upload" accept="image/*" style="display:none;">
                            </div>
                        </div>
                        <div class="conatiner_btn_adm ">
                            <button type="submit" name="cadastrarSecundario" class="btn_salvar_adm">Salvar</button>
                        </div>
                    </form>
            
                    <!-- Banners Promocionais -->
                    <form method="POST" enctype="multipart/form-data" class="item_top_produto">
                        <h4 class="title_banner_categoria">Banners Promocionais</h4>
                        <div class="tamanho_banner_adm">Tamanho recomendável (1700x700px)</div>
                        <div class="container_banner_wrap-promocional" id="banner-secundario">
                            <div class="banner-item-promocional">
                                <img src="<?= $bannerPromocionalPosicao1->caminho; ?>" alt="Imagem 1" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input name="bannerPromocional1" type="file" class="file-upload" accept="image/*" style="display: none;">
                            </div>
                            <div class="quadro-banners-promo">
                                <div class="banner-item-promo">
                                    <img src="<?= $bannerPromocionalPosicao2->caminho; ?>" alt="Imagem 2" class="preview-image banner-image">
                                    <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                    <input name="bannerPromocional2" type="file" class="file-upload" accept="image/*" style="display: none;">
                                </div>
                                <div class="banner-item-promo">
                                    <img src="<?= $bannerPromocionalPosicao3->caminho; ?>" alt="Image 3" class="preview-image banner-image">
                                    <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                    <input name="bannerPromocional3" type="file" class="file-upload" accept="image/*" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <div  class="conatiner_btn_adm ">
                            <button type="submit" name="cadastrarPromocionais" class="btn_salvar_adm">Salvar</button>
                        </div>
                    </form>

                    <!-- Banners Mobile -->
                    <form name="formMobile" method="POST" enctype="multipart/form-data" class="item_top_produto">
                        <h4 class="title_banner_categoria">Banners Mobile</h4>
                        <div class="tamanho_banner_adm">Tamanho recomendável (1080x1080px)</div>
                        <div class="container_banner_wrap" id="banner-mobile">
                            <div class="banner-item">
                                <img src="<?= $bannerMobilePosicao1->caminho; ?>" alt="Imagem 1" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input type="file" class="file-upload" accept="image/*" style="display:none;" name="bannerMobile1">
                            </div>
                            <div class="banner-item">
                                <img src="<?= $bannerMobilePosicao2->caminho; ?>" alt="Imagem 1" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input type="file" class="file-upload" accept="image/*" style="display:none;" name="bannerMobile2">
                            </div>
                            <div class="banner-item">
                                <img src="<?= $bannerMobilePosicao3->caminho; ?>" alt="Imagem 1" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input type="file" class="file-upload" accept="image/*" style="display:none;" name="bannerMobile3">
                            </div>
                        </div>
                        <div  class="conatiner_btn_adm ">
                            <button type="submit" name="cadastrarMobile" class="btn_salvar_adm">Salvar</button>
                        </div>
                    </form>
            
                    <!-- Banners Categoria
                    <div class="item_top_produto">
                        <h4 class="title_banner_categoria">Banners Categoria</h4>
                        <div class="tamanho_banner_adm">Tamanho recomendável (750x980px)</div>
                        <div class="container_banner_wrap" id="banner-categoria">
                            <div class="banner-item">
                                <img src="../src/imagens/img_categorias_2/7.png" alt="Imagem 1" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input type="file" class="file-upload" accept="image/*" style="display:none;">
                            </div>
                        </div>
                        <div class="container_btn_salvar_excluir_produto_mobile">
                            <button class="btn_salvar_produto">Salvar</button>
                        </div>
                    </div> -->
            
                    <!-- Banners Sobre Mim -->
                    <!-- <form method="POST" enctype="multipart/form" class="item_top_produto">
                        <h4 class="title_banner_categoria">Banners Sobre Mim</h4>
                        <div class="tamanho_banner_adm">Tamanho recomendável (1000x500px)</div>
                        <div class="container_banner_wrap" id="banner-sobre-mim">
                            <div class="banner-item">
                                <img src="../src/imagens/SobreMim/1.png" alt="Imagem 1" class="preview-image banner-image">
                                <button class="trocar-imagem-btn"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-file-image"></i></button>
                                <input type="file" class="file-upload" accept="image/*" style="display:none;">
                            </div>
                        </div>
                        <div  class="conatiner_btn_adm ">
                            <button  type="submit" name="carregarDadosProduto" class="btn_salvar_adm">Salvar</button>
                        </div>
                        <div id="modalSucesso" class="modal-sucesso">
                            <div class="modal-conteudo">
                                <span class="fechar" onclick="fecharModal()">&times;</span>
                                <p><strong>✔ Sucesso!</strong> A operação foi realizada corretamente.</p>
                            </div>
                        </div>
                    </fomr>             -->
                </div>
            </div>
        </div>
    </main>
    <script>
function mostrarModal() {
    const modal = document.getElementById("modalSucesso");
    modal.style.display = "block";

    // Fecha automaticamente após 3 segundos
    setTimeout(() => {
       modal.style.display = "none";
    }, 3000); // 3000 milissegundos = 3 segundos
}

function fecharModal() {
    document.getElementById("modalSucesso").style.display = "none";
}
</script>

<!-- PHP ativa o modal se operação for bem-sucedida -->
<?php if (isset($mostrarModal) && $mostrarModal === true): ?>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function  () {
            // Mostra o modal verdinho simples
            mostrarModal();

            // E também mostra o SweetAlert como reforço visual
            Swal.fire({
                icon: 'success',
                title: 'Salvo com sucesso!',
                showConfirmButton: false,
                timer: 1000
            });
        };
    </script>
<?php endif; ?>
    <script src="cadastrar_banner.js"></script>
    <script src="adm_nav.js"></script>
    <script src="btn_listar_adm.js"></script>
</body>
</html>