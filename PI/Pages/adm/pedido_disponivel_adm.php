<?php
session_start();
// include "head_adm.php";
include "nav_bar_adm.php";
require_once '../../App/Entity/Pedido.class.php';

$id = $_GET['search'];
$entity = new Pedido();

$pedido_cliente = $entity->buscar_pedido_by_id($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['selectStatus'] ?? '';
    $codigo = $_POST['rastreio'] ?? '';

    $entity->status_pedido = $status;
    $entity->codigo_rastreio = $codigo;

    $resultado = $entity->atualizarPedido($id);

    if($resultado){
        $mostrarModal = true;
        if($mostrarModal == true){
            echo '<meta http-equiv="refresh" content="1.9">';
        }
    }
}
?>

<main class="main_adm">
    <div class="conatiner_dashbord_adm">
        <div class="Title_deafult_adm">
            <div class="container_title_adm_left">
                <a href="./listar_pedidos_adm.php" style="text-decoration: none; color: gray"><i class="fa-solid fa-chevron-left"></i></a>
                <span class="title_adm">Pedido #<?= $_GET['search']; ?></span>
            </div>
        </div>

        <div class="conatiner_cadastro_adm_items">
            <form action="" method="POST">
                <div class="conatiner_cadastro_adm_pedido_header">
                    <div class="item_flex_pedido">
                        <label for="">Cliente</label>
                        <input readonly type="text" value="<?= $pedido_cliente->nome_cliente . ' ' . $pedido_cliente->sobrenome; ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Contato</label>
                        <input readonly id="input_2_pedido" type="text" value="<?= $pedido_cliente->contato; ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">CEP</label>
                        <input readonly id="input_2_pedido" type="text" value="<?= $pedido_cliente->cep; ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Rua</label>
                        <input readonly type="text" value="<?= $pedido_cliente->rua; ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">N°</label>
                        <input readonly id="input_3_pedido" type="text" value="<?= $pedido_cliente->numero; ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Bairro</label>
                        <input readonly type="text" value="<?= $pedido_cliente->bairro; ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Cidade</label>
                        <input readonly type="text" value="<?= $pedido_cliente->cidade; ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Estado</label>
                        <input readonly id="input_3_pedido" type="text" value="<?= $pedido_cliente->estado; ?>">
                    </div>
                </div>

                <div class="shape_pedido"></div>

                <div class="conatiner_cadastro_adm_pedido_body">
                    <div class="conatiner_cadastro_adm_pedido_body_left">
                        <div class="item_flex_pedido">
                            <label for="">Produto</label>
                            <input readonly type="text" value="<?= $pedido_cliente->nome_produto; ?>">
                        </div>
                        <div class="item_flex_pedido">
                            <label for="">Quant.</label>
                            <input id="input_3_pedido" readonly type="text" value="<?= $pedido_cliente->quantidade; ?>">
                        </div>
                        <div class="item_flex_pedido">
                            <label for="">Cor</label>
                            <input id="input_2_pedido" readonly type="text" value="<?= $pedido_cliente->cor; ?>">
                        </div>
                        <div class="item_flex_pedido">
                            <label for="">Preço Total</label>
                            <input id="input_2_pedido" readonly type="text" value="<?= $pedido_cliente->valor_total; ?>">
                        </div>

                        <div class="item_flex_pedido">
                            <label for="">Status Pedido</label>
                            <select name="selectStatus" id="selectStatus">
                                <?php if($pedido_cliente->status_pedido === "A pagar"): ?>
                                    <option value="A pagar" selected>A pagar</option>
                                    <option value="Produção">Produção</option>
                                    <option value="Envio">Envio</option>
                                    <option value="Entregue">Entregue</option>
                                <?php elseif($pedido_cliente->status_pedido === "Produção"):?>
                                    <option value="A pagar">A pagar</option>
                                    <option value="Produção" selected>Produção</option>
                                    <option value="Envio">Envio</option>
                                    <option value="Entregue">Entregue</option>
                                <?php elseif($pedido_cliente->status_pedido === "Envio"):?>
                                    <option value="A pagar">A pagar</option>
                                    <option value="Produção">Produção</option>
                                    <option value="Envio" selected>Envio</option>
                                    <option value="Entregue">Entregue</option>
                                <?php elseif($pedido_cliente->status_pedido === "Entregue"):?>
                                    <option value="A pagar">A pagar</option>
                                    <option value="Produção">Produção</option>
                                    <option value="Envio">Envio</option>
                                    <option value="Entregue" selected>Entregue</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="item_flex_pedido">
                            <label for="">Código de Rastreio</label>
                            <input type="text" name="rastreio" value="<?= $pedido_cliente->rastreio ?>">
                        </div>
                    </div>

                    <div class="conatiner_cadastro_adm_pedido_body_right">
                        <div class="item_flex_pedido">
                            <label for="">Imagem</label>
                            <img src="<?= $pedido_cliente->imagem; ?>" class="conatiner_img_pedido_adm" alt="">
                        </div>
                    </div>
                </div>

                <!-- Botão Salvar dentro do form -->
                <div id="conatiner_btn_adm_pc" class="conatiner_btn_adm">
                    <button type="submit" class="btn_salvar_adm">Salvar</button>
                </div>
                <div id="modalSucesso" class="modal-sucesso">
                    <div class="modal-conteudo">
                        <span class="fechar" onclick="fecharModal()">&times;</span>
                        <p><strong>✔ Sucesso!</strong> A operação foi realizada corretamente.</p>
                    </div>
                </div>
            </form>
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

<script src="adm_nav.js"></script>
<script src="btn_listar_adm.js"></script>
</body>
</html>
