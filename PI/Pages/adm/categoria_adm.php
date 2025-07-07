<?php

include 'nav_bar_adm.php';

$err = '';
$errImg = '';
if(isset($_GET)){
    $id_categoria = $_GET['id'];
    // print_r($id_categoria);
}

$entity = new Categoria();
$categoria = $entity->SelectCategoriaPorId($id_categoria);
// print_r($categoria);


if (isset($_POST['carregarDadosCategoria'])) {
    $titulo = $_POST['tituloCategoria'];
    $status = $_POST['selectStatus'];

    $entity->nome = $titulo;
    $entity->status_categoria = $status;

    // Verifica se um novo arquivo foi enviado e não está vazio
    if (isset($_FILES['imagemCategoria']) && $_FILES['imagemCategoria']['error'] === UPLOAD_ERR_OK && $_FILES['imagemCategoria']['size'] > 0) {
        $extensoesPermitidas = ['png', 'jpg', 'jpeg', 'jfif'];
        $pastaDestino = '../../src/imagens/categorias/';
        $imagem = $_FILES['imagemCategoria'];
        $nomeOriginal = $imagem['name'];
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        if (!in_array($extensao, $extensoesPermitidas)) {
            $errImg = "A extensão do arquivo \"$nomeOriginal\" não é permitida.";
        } else {
            $novoNome = uniqid('ImagemCategoria_', true) . '.' . $extensao;
            $caminhoFinal = $pastaDestino . $novoNome;

            if (move_uploaded_file($imagem['tmp_name'], $caminhoFinal)) {
                $entity->imagem = $caminhoFinal;

                // Deleta imagem anterior se for diferente
                if (file_exists($categoria->imagem) && $categoria->imagem !== $caminhoFinal) {
                    unlink($categoria->imagem);
                }
            } else {
                $errImg = "Falha ao mover a imagem para o destino.";
            }
        }
    } else {
        // Se nenhuma nova imagem for enviada, mantém a atual
        $entity->imagem = $categoria->imagem;
    }

    // Se não houver erro de imagem, tenta atualizar
    if (empty($errImg)) {
        $resultado = $entity->atualizarCategoria($id_categoria);

        if ($resultado) {
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
}



?>
    
    <main class="main_adm">
        <form method="POST" enctype="multipart/form-data" class="conatiner_dashbord_adm">
            <div class="Title_deafult_adm">
                <div class="container_title_adm_left">
                    <a href="./listar_categoria_adm.php" style="text-decoration: none; color: #ccc"><i class="fa-solid fa-chevron-left"></i></a>
                    <span class="title_adm">Categoria N°<?= $id_categoria; ?> </span>
                </div>
                <div class="container_title_adm_right">
                    <!-- <div class="conatiner_btn_adm mobile_btn_salvar">
                        <button class="btn_excluir_adm">Excluir</button>
                        <button class="btn_salvar_adm">Salvar</button>
                    </div> -->
                </div>
            </div>
            <div class="conatiner_cadastro_adm_items">
                <div class="conatiner_cadastro_adm_items_header">
                    <div class="conatiner_cadastro_adm_items_header_left">
                        <div class="item_flex_adm">
                            <label for="">Titulo</label>
                            <input type="text" id="tituloCategoria" name="tituloCategoria" value="<?= $categoria->nome; ?>">
                            <p class="text_tamanho_img" style="color:red;"> <?= $err; ?> </p>
                        </div>
                        <div class="item_flex_adm">
                            <label for="">Status</label>
                            <select name="selectStatus" id="selectStatus">
                                <?php if($categoria->status_categoria === "a"): ?>
                                    <option value="ativo" selected>Ativo</option>
                                    <option value="inativo">Inativo</option>
                                <?php else: ?>
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo" selected>Inativo</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!-- <div class="item_flex_adm">
                            <label for="">Descrição</label>
                            <textarea name="" id=""></textarea>
                        </div> -->
                        
                    </div>
                    <div class="conatiner_cadastro_adm_items_header_right">
                        <div class="item_flex_adm">
                            <label for="">Imagem</label>
                            <div class="conatiner_img_add_adm add_img_categoria">
                                <img  class="imagemCategoria-active" src="<?= $categoria->imagem; ?>" alt="" id="preview_img">
                                <input type="file" name="imagemCategoria" id="imgInput"  class="imagemCategoria" >
                            </div>
                            <p>Clique na Imagem para Trocar <i class="fa-solid fa-pencil"></i></p>
                            <p style= "color: red;" ><?= $errImg;?></p>
                            <p class="text_tamanho_img">Tamanho recomendavel (1700x700px)</p>
                        </div>

                    </div>
                </div>
                <!-- <div class="conatiner_cadastro_adm_items_body">
                    <div class="conatiner_cadastro_adm_items_body_pesquisa">
                        <div class="item_flex_adm">
                            <label for="">Pesquisar Produto</label>
                            <input type="text">
                        </div>
                        <button class="btn_buscar_pesquisa">Buscar</button>
                        <button class="btn_produto_add">+ Produto</button>

                    </div>
                    <div class="conatiner_cadastro_adm_items_body_list">
                        <table class="table_adm_list">
                            <tr z>
                                <th id="text_alin_item">ID</th>
                                <th id="text_alin_item">produto</th>
                                <th>estoque</th>
                                <th>status</th>
                                <th>ações</th>
                            </tr>
                            <tr>
                                <td id="text_alin_item" >
                                   1
                                </td>
                                <td class="nome_td">
                                    <div class="conatiner_item_list_nome">
                                        <img src="" alt="">
                                        <div class="conatiner_text_nome_list">
                                            <p>Cachepô de Crochê</p>
                                            <span>Lorem ipsum dolor sit amet consectetu.</span>
                                        </div>
                                        
                                    </div>
                                    
                                </td>
                                <td>
                                    16
                                </td>
                                <td>
                                    <div class="container_item_list_status">
                                        <div class="shape_status"></div>
                                        ativo
                                        
                                    </div>
                                </td>
                                <td>
                                    <div class="container_item_list_ações">
                                        <a href=""><i class="fa-solid fa-pencil"></i></a>
                                        <input checked="true" type="checkbox" class="switch">
                                        <a href=""><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td id="text_alin_item" >
                                   1
                                </td>
                                <td class="nome_td">
                                    <div class="conatiner_item_list_nome">
                                        <img src="" alt="">
                                        <div class="conatiner_text_nome_list">
                                            <p>Cachepô de Crochê</p>
                                            <span>Lorem ipsum dolor sit amet consectetu.</span>
                                        </div>
                                        
                                    </div>
                                    
                                </td>
                                <td>
                                    16
                                </td>
                                <td>
                                    <div class="container_item_list_status">
                                        <div class="shape_status"></div>
                                        ativo
                                        
                                    </div>
                                </td>
                                <td>
                                    <div class="container_item_list_ações">
                                        <a href=""><i class="fa-solid fa-pencil"></i></a>
                                        <input checked="true" type="checkbox" class="switch">
                                        <a href=""><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
    
                        </table>

                    </div>



                </div> -->

            </div>
            <div id="conatiner_btn_adm_pc" class="conatiner_btn_adm">
                <!-- <button onclick="window.location.reload()" class="btn_excluir_adm">Excluir</button> -->
                <button type="submit" name="carregarDadosCategoria" class="btn_salvar_adm">Salvar</button>
            </div>
            <div id="modalSucesso" class="modal-sucesso">
                <div class="modal-conteudo">
                    <span class="fechar" onclick="fecharModal()">&times;</span>
                    <p><strong>✔ Sucesso!</strong> A operação foi realizada corretamente.</p>
                </div>
            </div>
        </form>
    </main>
<script>
function mostrarModal() {
    const modal = document.getElementById("modalSucesso");
    modal.style.display = "block";

    // Fecha automaticamente após 3 segundos
    setTimeout(() => {
        modal.style.display = "none";
        
    }, 1);
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
                title: 'Atualizado com Sucesso',
                showConfirmButton: false,
                timer: 1000
            });
        };

    </script>
<?php endif; ?>
    <script src="adm_nav.js"></script>
    <script src="btn_listar_adm.js"></script>
</body>
</html>