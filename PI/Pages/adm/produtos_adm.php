<?php
session_start();

include "nav_bar_adm.php";

require_once '../../App/config.inc.php';
require_once '../../App/Session/Login.php';
$result = Login::IsLogedAdm();
if($result){
    $id_administrador = $_SESSION['administrador']['id_administrador'];
}
else{
    header('location: ../user/login.php');
}

$errTitulo = "";
$errStatus = "";
$errCategoria = "";
$errDescricao = "";
$errImagem = "";
$errPreco = "";
$errCor = "";
$errAltura = "";
$errLargura = "";
$errEstoque = "";
if(isset($_GET['id'])){
    $id_produto = $_GET['id'];
}
$entity = new Produto();
$produto = $entity->buscarProdutoPorId($id_produto);

if (isset($_POST['carregarDadosProduto'])) {
    $titulo = $_POST['tituloProduto'];
    $status = $_POST['selectStatus'];
    $categoria = $_POST['selectCategoria'];
    $descricao = $_POST['descricaoProduto'];
    $cor = $_POST['corProduto'];
    $altura = $_POST['alturaProduto'];
    $largura = $_POST['larguraProduto'];
    $estoque = $_POST['estoqueProduto'];
    $preco = $_POST['precoProduto'];

    // Validações simples
    if (empty($titulo)) $errTitulo = "Adicione um título";
    if (empty($status)) $errStatus = "Escolha o status";
    if (empty($categoria)) $errCategoria = "Escolha uma categoria";
    if (empty($descricao)) $errDescricao = "Adicione uma descrição";
    if (empty($cor)) $errCor = "Adicione uma cor";
    if (empty($altura)) $errAltura = "Adicione uma altura";
    if (empty($largura)) $errLargura = "Adicione uma largura";
    if (empty($estoque)) $errEstoque = "Adicione um estoque";
    if (empty($preco)) $errPreco = "Adicione um preço";

    // Só continua se todos os campos estiverem preenchidos
    if (empty($errTitulo) && empty($errStatus) && empty($errCategoria) && empty($errDescricao) && empty($errCor) && empty($errAltura) && empty($errLargura) && empty($errEstoque) && empty($errPreco)) {
        
        $imagemNova = false;

        // Trata imagem, se uma nova for enviada
        if (isset($_FILES['imagemProduto']) && $_FILES['imagemProduto']['error'] === UPLOAD_ERR_OK && $_FILES['imagemProduto']['size'] > 0) {
            $extensoesPermitidas = ['png', 'jpg', 'jpeg', 'jfif'];
            $pastaDestino = '../../src/imagens/produtos/';
            $imagem = $_FILES['imagemProduto'];
            $nomeOriginal = $imagem['name'];
            $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

            if (!in_array($extensao, $extensoesPermitidas)) {
                $errImagem = "A extensão do arquivo \"$nomeOriginal\" não é permitida.";
            } else {
                $novoNome = uniqid('ImagemProduto_', true) . '.' . $extensao;
                $caminhoFinal = $pastaDestino . $novoNome;

                if (move_uploaded_file($imagem['tmp_name'], $caminhoFinal)) {
                    // Apaga imagem anterior, se for diferente
                    if (file_exists($produto->imagem) && $produto->imagem !== $caminhoFinal) {
                        unlink($produto->imagem);
                    }
                    $imagemNova = $caminhoFinal;
                } else {
                    $errImagem = "Falha ao mover a imagem para o destino.";
                }
            }
        }

        // Se não houve erro de imagem, continua
        if (empty($errImagem)) {
            $entity = new Produto();
            $entity->nome = $titulo;
            $entity->preco = $preco;
            $entity->avaliacao = ""; // Se não for usado, pode remover
            $entity->quantidade = $estoque;
            $entity->cor = $cor;
            $entity->altura = $altura;
            $entity->largura = $largura;
            $entity->imagem = $imagemNova ? $imagemNova : $produto->imagem;
            $entity->descricao = $descricao;
            $entity->tipo = "Da loja";
            $entity->status_produto = $status;
            $entity->categoria_id_categoria = $categoria;

            $resultado = $entity->atualizarProduto($id_produto);
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
}

?>
<body>   
    <main class="main_adm">
        <form method="POST" enctype="multipart/form-data" class="conatiner_dashbord_adm">
            <div class="Title_deafult_adm">
                <div class="container_title_adm_left">
                    <a href="./listar_produtos_adm.php" style="text-decoration: none; color: #ccc"><i class="fa-solid fa-chevron-left"></i></a>
                    <span class="title_adm">Produto N°<?= $id_produto; ?></span>
                </div>
            </div>
            <div class="conatiner_cadastro_adm_items">
                <div class="conatiner_cadastro_adm_items_header">
                    <div class="conatiner_cadastro_adm_items_header_left">
                        <div class="item_flex_adm">
                            <label for="">Titulo</label>
                            <input type="text" name="tituloProduto" value="<?= $produto->nome; ?>">
                            <p class="text_tamanho_img" style="color:red;"> <?= $errTitulo; ?> </p>
                        </div>
                        <div class="item_flex_adm">
                            <label for="">Status</label>
                            <select name="selectStatus" id="selectStatus">
                                <?php if($produto->status_produto === "a"): ?>
                                    <option value="ativo" selected>Ativo</option>
                                    <option value="inativo">Inativo</option>
                                <?php else: ?>
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo" selected>Inativo</option>
                                <?php endif; ?>
                            </select>
                            <p class="text_tamanho_img" style="color:red;"> <?= $errStatus; ?> </p>
                        </div>
                        <div class="item_flex_adm">
                            <label for="">Categoria</label>
                            <script>
                                const categoriaSelecionada = <?= $produto->categoria_id_categoria ?>;
                            </script>
                            <select name="selectCategoria" id="dadosTodasCategoria">
                                <!-- <option value="">Amigurumi</option>
                                <option value="">Cachepô</option> -->
                            </select>
                            <p class="text_tamanho_img" style="color:red;"> <?= $errCategoria; ?> </p>
                        </div>
                        <div class="item_flex_adm">
                            <label for="">Descrição</label>
                            <textarea name="descricaoProduto" id="" value=""><?= $produto->descricao ?></textarea>
                            <p class="text_tamanho_img" style="color:red;"> <?= $errDescricao; ?> </p>
                        </div>
                        
                    </div>
                    <div class="conatiner_cadastro_adm_items_header_right">
                        <div class="conatiner_img_add_adm add_img_categoria">
                                <img  class="imagemCategoria-active" src="<?= $produto->imagem; ?>" alt="" id="preview_img">
                                <input type="file" name="imagemProduto" id="imgInput"  class="imagemCategoria" >
                            </div>
                            <p>Clique na Imagem para Trocar <i class="fa-solid fa-pencil"></i></p>
                            <p style="color: red;"><?= $errImagem;?></p>
                    </div>
                </div>
                <div class="conatiner_cadastro_adm_items_body">
                    <div class="conatiner_cadastro_adm_items_body_add">
                        <div class="item_flex_adm">
                            <label for="">Preço</label>
                            <input type="text" name="precoProduto" class="input_adcionar_produto" value="<?= $produto->preco; ?>">
                            <p class="text_tamanho_img" style="color:red;"> <?= $errPreco; ?> </p>
                        </div>
                        <div class="item_flex_adm">
                            <label for="">Adicionar Cor</label>
                            <input name="corProduto" class="input_adcionar_produto" type="color" value="<?= $produto->cor; ?>">
                            <p class="text_tamanho_img" style="color:red;"> <?= $errCor; ?> </p>
                        </div>
                        <!-- <button class="btn_produto_add">Adicionar</button> -->
                        <div class="item_flex_adm">
                            <label for="">Adicionar Altura</label>
                            <input name="alturaProduto" placeholder="cm" class="input_adcionar_produto" type="text" value="<?=$produto->altura; ?>">
                            <p class="text_tamanho_img" style="color:red;"> <?= $errAltura; ?> </p>
                        </div> 
                        <div class="item_flex_adm">
                            <label for="">Adicionar Largura</label>
                            <input name="larguraProduto" placeholder="cm"class="input_adcionar_produto" type="text" value="<?=$produto->largura; ?>" >
                            <p class="text_tamanho_img" style="color:red;"> <?= $errLargura; ?> </p>
                        </div>
                    </div>
                    <div class="conatiner_cadastro_adm_items_body_2">
                        <!-- <button class="btn_produto_add">Adicionar</button> -->
                        <div class="item_flex_adm2">
                            <label for="">Adicionar Estoque</label>
                            <input name="estoqueProduto" class="input_adcionar_produto" type="number" value="<?=$produto->quantidade; ?>">
                            <p class="text_tamanho_img" style="color:red;"> <?= $errEstoque; ?> </p>
                        </div>
                        <!-- <button class="btn_produto_add">Adicionar</button> -->
                    </div>
                </div>
            </div>
            <div id="conatiner_btn_adm_pc"  class="conatiner_btn_adm">
                <!-- <button class="btn_excluir_adm">Excluir</button> -->
                <button type="submit" name="carregarDadosProduto" class="btn_salvar_adm">Salvar</button>
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
                title: 'Salvo com sucesso!',
                showConfirmButton: false,
                timer: 1000
            });
        };
    </script>
<?php endif; ?>
    <!-- <script src="adm_nav.js"></script>
    <script src="btn_listar_adm.js"></script> -->
</body>
</html>