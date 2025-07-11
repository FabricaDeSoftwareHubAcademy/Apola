<?php
session_start();

include "nav_bar_adm.php";
require_once '../../App/Entity/Pedido.class.php';

$id = $_GET['search'] ?? null;

if (!$id) {
    echo "ID do pedido não informado.";
    exit;
}

$entity = new Pedido();
$pedido_cliente = $entity->buscar_pedidoperso_by_id($id);
print_r($pedido_cliente);

if (!$pedido_cliente) {
    echo "Pedido personalizado não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['selectStatus'] ?? '';
    $codigo = $_POST['codigo_rastreio'] ?? '';
    $valor = $_POST['valor_total_perso'] ?? '';

    // Atualizando os dados no objeto entity
    $entity->status_pedido = $status;
    $entity->codigo_rastreio = $codigo;
    $entity->valor_total_perso = $valor;

    $resultado = $entity->atualizarPedido($id);

    if ($resultado) {
        $mostrarModal = true;
        // Refresh após salvar para atualizar os dados na tela
        echo '<meta http-equiv="refresh" content="1.9">';
    }
}
?>

<main class="main_adm">
    <div class="conatiner_dashbord_adm">
        <div class="Title_deafult_adm">
            <div class="container_title_adm_left">
                <a href="./listar_pedidos_adm.php" style="text-decoration: none; color: gray">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                <span class="title_adm">Pedido #<?= htmlspecialchars($id); ?></span>
            </div>
        </div>
        <div class="conatiner_cadastro_adm_items">
            <form action="" method="POST">
                <div class="conatiner_cadastro_adm_pedido_header">
                    <div class="item_flex_pedido">
                        <label for="">Cliente</label>
                        <input readonly type="text" value="<?= htmlspecialchars($pedido_cliente->nome_cliente . ' ' . $pedido_cliente->sobrenome); ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Contato</label>
                        <input readonly id="input_2_pedido" type="text" value="<?= htmlspecialchars($pedido_cliente->contato); ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">CEP</label>
                        <input readonly id="input_2_pedido" type="text" value="<?= htmlspecialchars($pedido_cliente->cep); ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Rua</label>
                        <input readonly type="text" value="<?= htmlspecialchars($pedido_cliente->rua); ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">N°</label>
                        <input readonly id="input_3_pedido" type="text" value="<?= htmlspecialchars($pedido_cliente->numero); ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Bairro</label>
                        <input readonly type="text" value="<?= htmlspecialchars($pedido_cliente->bairro); ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Cidade</label>
                        <input readonly type="text" value="<?= htmlspecialchars($pedido_cliente->cidade); ?>">
                    </div>
                    <div class="item_flex_pedido">
                        <label for="">Estado</label>
                        <input readonly id="input_3_pedido" type="text" value="<?= htmlspecialchars($pedido_cliente->estado); ?>">
                    </div>
                    <div class="shape_pedido"></div>
                    <div class="conatiner_cadastro_adm_pedido_body">
                        <div class="conatiner_cadastro_adm_pedido_body_left_persononalizado">
                            <div class="item_flex_pedido">
                                <label for="">Descrição</label>
                                <textarea readonly><?= htmlspecialchars($pedido_cliente->descricao_personalizada); ?></textarea>
                            </div>
                        </div>
                        <div class="conatiner_cadastro_adm_pedido_body_right_persononalizado">
                            <div class="item_flex_pedido">
                                <label for="selectStatus">Status Pedido</label>
                                <select name="selectStatus" id="selectStatus">
                                    <option value="A pagar" <?= $pedido_cliente->status_pedido === "A pagar" ? 'selected' : ''; ?>>A pagar</option>
                                    <option value="Produção" <?= $pedido_cliente->status_pedido === "Produção" ? 'selected' : ''; ?>>Produção</option>
                                    <option value="Envio" <?= $pedido_cliente->status_pedido === "Envio" ? 'selected' : ''; ?>>Envio</option>
                                    <option value="Entregue" <?= $pedido_cliente->status_pedido === "Entregue" ? 'selected' : ''; ?>>Entregue</option>
                                </select>
                            </div>
                            <div class="item_flex_pedido">
                                <label for="">Preço Total</label>
                                <input type="text" name="valor_total_perso" id="valor_total_perso" value="<?= htmlspecialchars($pedido_cliente->valor_total); ?>">
                            </div>
                            <div class="item_flex_pedido">
                                <label for="codigo_rastreio">Código de Rastreio</label>
                                <input type="text" name="codigo_rastreio" id="codigo_rastreio" value="<?= htmlspecialchars($pedido_cliente->codigo_rastreio ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="conatiner_cadastro_adm_pedido_footer">
                        <div class="item_flex_pedido">
                            <label for="">Imagem</label>
                            <div class="conatiner_img_pedido_perso_adm">
                                <img src="<?= htmlspecialchars($pedido_cliente->imagem1); ?>" class="foto_perso" alt="">
                                <img src="<?= htmlspecialchars($pedido_cliente->imagem2); ?>" class="foto_perso" alt="">
                                <img src="<?= htmlspecialchars($pedido_cliente->imagem3); ?>" class="foto_perso" alt="">
                                <img src="<?= htmlspecialchars($pedido_cliente->imagem4); ?>" class="foto_perso" alt="">
                            </div>
                        </div>
                    </div>
                    <div id="conatiner_btn_adm_pc" class="conatiner_btn_adm ">
                        <button class="btn_salvar_adm" type="submit">Salvar</button>
                    </div>
                    <div id="modalSucesso" class="modal-sucesso" style="display:none;">
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

    setTimeout(() => {
       modal.style.display = "none";
    }, 1900);
}

function fecharModal() {
    document.getElementById("modalSucesso").style.display = "none";
}
</script>

<?php if (isset($mostrarModal) && $mostrarModal === true): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function() {
            mostrarModal();
            Swal.fire({
                icon: 'success',
                title: 'Salvo com sucesso!',
                showConfirmButton: false,
                timer: 1500
            });
        };
    </script>
<?php endif; ?>

<script src="adm_nav.js"></script>
<script src="btn_listar_adm.js"></script>
</body>
</html>
