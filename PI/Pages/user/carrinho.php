<?php
// /home/felix/Desktop/Apola/PI/Pages/user/carrinho.php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carregamento único do autoload e do .env
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../App/config.inc.php';

// Autenticação de login
require_once __DIR__ . '/../../App/Session/Login.php';

// Agora você pode usar suas classes
use App\Controllers\CartController;
use App\DB\Database;

try {
    $db = new Database();
    $pdo = $db->pdo;
    require_once __DIR__ . '/../../App/Controllers/CartController.php';
    $cartController = new CartController($pdo);
} catch (Exception $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}

$cartData = $cartController->showCart();
$cartItems = $cartData['cartItems'];
$subtotal = $cartData['subtotal'];
$shipping = $cartData['shipping'];
$total = $cartData['total'];

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    // REMOVE THIS: session_start(); // Already started at top
    
    $productId = (int)($_POST['id'] ?? 0);
    $action = $_POST['action'];
    
    try {
        if ($action === 'update') {
            $quantity = (int)($_POST['qty'] ?? 1);
            $cartController->updateQuantity($productId, $quantity);
        } 
        elseif ($action === 'remove') {
            $cartController->removeFromCart($productId);
        }
        
        // Return updated cart data
        $cartData = $cartController->showCart();
        echo json_encode([
            'status' => 'success',
            'cartItems' => $cartData['cartItems'],
            'subtotal' => $cartData['subtotal'],
            'shipping' => $cartData['shipping'],
            'total' => $cartData['total'],
            'cartCount' => array_sum(array_column($_SESSION['cart'] ?? [], 'quantidade'))
        ]);
        exit;
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    }
}

include 'header.php';

$result = Login::RequireLogout();

if ($result) {
    include 'navbar_logado.php';
} else {
    include 'navbar_deslogado.php';
}

// Debug cart items
// echo '<pre>';
// var_dump($cartItemsDetailed);
// echo '</pre>';

// echo '<pre>';
// print_r($_SESSION['cart']);
// echo '</pre>';

// TODO: output your cart items here in HTML

?>

<main class="main2">
    <div class="container_cart">
        <div class="container_header_cart">
            <a href="./home_logado.php" style="text-decoration: none;">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <div class="name_cart">SACOLA</div>
        </div>

        <div class="container_body_cart">
            <table class="cart-table">
                <thead>
                    <tr class="cart-header-row">
                        <th class="cart-header-product">Produto</th>
                        <th class="cart-header-price">Preço Un.</th>
                        <th class="cart-header-quantity">Quantidade</th>
                        <th class="cart-header-total">Total</th>
                    </tr>
                </thead>

                <tbody class="produto_list_cart">
                    <?php if (empty($cartItems)): ?>
                        <tr class="cart-empty-message">
                            <td colspan="4">
                                <div>Sua sacola está vazia.</div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($cartItems as $item): ?>
                        <tr class="produto_item_cart" data-id="<?= $item['id_produto'] ?>">
                            <!-- Product Column -->
                            <td class="produto_item_cart_left">
                                <div class="container_img_produto_cart">
                                    <img src="<?= htmlspecialchars($item['imagem'] ?? 'placeholder.jpg') ?>" 
                                        alt="<?= htmlspecialchars($item['nome']) ?>">
                                </div>
                                <div class="produto_item_cart_right">
                                    <h6 class="name_produto_cart"><?= htmlspecialchars($item['nome']) ?></h6>
                                    <div class="detalhes_produto_cart">
                                        <div class="cor_produto_cart">Cor: <?= htmlspecialchars($item['cor'] ?? '-') ?></div>
                                        <div class="tamanho_produto_cart">
                                            Tamanho: <?= htmlspecialchars($item['tamanho'] ?? '-') ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Price Column -->
                            <td class="produto_item_cart-2">
                                <h6 class="preco_produto_cart">
                                    R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                                </h6>
                            </td>
                            
                            <!-- Quantity Column -->
                            <td class="produto_item_cart-3">
                                <div class="quantity-controls">
                                    <button class="quantity-btn minus-btn"
                                            data-action="update"
                                            data-id="<?= $item['id_produto'] ?>"
                                            data-qty="<?= max(1, $item['quantidade'] - 1) ?>">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <span class="quantity-value"><?= $item['quantidade'] ?></span>
                                    <button class="quantity-btn plus-btn"
                                            data-action="update"
                                            data-id="<?= $item['id_produto'] ?>"
                                            data-qty="<?= $item['quantidade'] + 1 ?>">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            
                            <!-- Total Column -->
                            <td class="produto_item_cart-4">
                                <h6 class="preco_produto_cart line_total">
                                    R$ <?= number_format($item['line_total'], 2, ',', '.') ?>
                                </h6>
                                <button class="container_remover_produto_cart"
                                        data-action="remove"
                                        data-id="<?= $item['id_produto'] ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="shape_sacola"></div>
        </div>
        
        <!-- Cart Summary Section -->
        <div class="conatiner_final_carrinho">
            <div class="conatiner_final_carrinho_left">
                <div class="item_edereco_carrinho">
                    <div class="radio_cep" id="radio_cep2"></div>
                    <div class="text_carrinho_endereco">Endereço - Avenida Eucaliptos, 789, Centro, Rj - CEP: 79012-2321 </div>
                </div>
                <div class="item_edereco_carrinho">
                    <div class="radio_cep" id="radio_cep"></div>
                    <div class="text_carrinho_endereco">Outro endereço</div>
                </div>
                <div class="conatiner_cep_drop" id="conatiner_cep_drop">
                    <input type="text">
                    <button class="btn_input_cep"><i class="fa-solid fa-truck"></i></button>
                </div>
            </div>
            <div class="conatiner_final_carrinho_right">
                <div class="body_conatiner_final_right">
                    <div class="item_preco_carrinho">
                        <div class="preco_text_carrinho">SubTotal</div>
                        <div class="preco_text_carrinho subtotal-value">
                            R$ <?= number_format($subtotal, 2, ',', '.') ?>
                        </div>
                    </div>
                    <div class="linha_preco_carrinho"></div>
                    <div class="item_preco_carrinho">
                        <div class="preco_text_carrinho">Taxa de Entrega</div>
                        <div class="preco_text_carrinho shipping-value">
                            R$ <?= number_format($shipping, 2, ',', '.') ?>
                        </div>
                    </div>
                    <div class="linha_preco_carrinho"></div>
                    <div class="item_preco_carrinho">
                        <div style="font-weight: 600;" class="preco_text_carrinho">Valor Total</div>
                        <div style="font-weight: 600;" class="preco_text_carrinho total-value">
                            R$ <?= number_format($total, 2, ',', '.') ?>
                        </div>
                    </div>
                    <div class="linha_preco_carrinho"></div>
                    <div class="conatiner_btn_finalizar_compra_cart">
                        <button data-modal="modal-1" class="open-modal btn_finalizar">Finalizar Pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Dialog -->
<dialog id="modal-1">
    <div class="modal_header">
        <button class="close-modal" data-modal="modal-1"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal_body">
        <h5 class="title_modal_zap">Pedido Realizado!</h5>
        <div class="text_modal_zap">Segue o link do nosso WhatsApp para realizar o pagamento. Entraremos em contato em breve.</div>
        <div class="conatiner_item_modal_link_zap">
            <div class="item_modal_link_zap">
                <i class="fa-brands fa-whatsapp"></i>
                <a href="https://wa.me/">67 991924837</a>
            </div>
        </div>  
    </div>
</dialog>

<script src="../../src/JS/modal.js"></script>

<!-- Cart JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format currency function
    function formatCurrency(value) {
        const num = parseFloat(value) || 0;
        return 'R$ ' + num.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Render cart items dynamically with AJAX
    function renderCartItem(item) {
        return `
            <tr class="produto_item_cart" data-id="${item.id_produto}">
                <!-- Product Column -->
                <td class="produto_item_cart_left">
                    <div class="container_img_produto_cart">
                        <img src="${item.imagem || 'placeholder.jpg'}" alt="${item.nome}">
                    </div>
                    <div class="produto_item_cart_right">
                        <h6 class="name_produto_cart">${item.nome}</h6>
                        <div class="detalhes_produto_cart">
                            <div class="cor_produto_cart">Cor: ${item.cor}</div>
                            <div class="tamanho_produto_cart">
                                Tamanho: ${item.altura && item.largura ? (item.altura + 'x' + item.largura) : '-'}
                            </div>
                        </div>
                    </div>
                </td>
                
                <!-- Price Column -->
                <td class="produto_item_cart-2">
                    <h6 class="preco_produto_cart">
                        ${formatCurrency(item.preco)}
                    </h6>
                </td>
                
                <!-- Quantity Column -->
                <td class="produto_item_cart-3">
                    <div class="quantity-controls">
                        <button class="quantity-btn minus-btn"
                                data-action="update"
                                data-id="${item.id_produto}"
                                data-qty="${Math.max(1, item.quantidade - 1)}">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <span class="quantity-value">${item.quantidade}</span>
                        <button class="quantity-btn plus-btn"
                                data-action="update"
                                data-id="${item.id_produto}"
                                data-qty="${item.quantidade + 1}">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </td>
                
                <!-- Total Column -->
                <td class="produto_item_cart-4">
                    <h6 class="preco_produto_cart line_total">
                        ${formatCurrency(item.line_total)}
                    </h6>
                    <button class="container_remover_produto_cart"
                            data-action="remove"
                            data-id="${item.id_produto}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    }

    // Render cart items container
    function renderCartItems(cartItems) {
        if (cartItems.length === 0) {
            return `
                <tr class="cart-empty-message">
                    <td colspan="4">
                        <div>Sua sacola está vazia.</div>
                    </td>
                </tr>
            `;
        }
        return cartItems.map(renderCartItem).join('');
    }

    // Handle cart actions
    async function handleCartAction(e) {
        const target = e.target.closest('[data-action]');
        if (!target) return;
        
        e.preventDefault();
        
        const action = target.dataset.action;
        const id = target.dataset.id;
        const qty = target.dataset.qty ? parseInt(target.dataset.qty) : null;
        
        try {
            const response = await fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=${action}&id=${id}${qty ? `&qty=${qty}` : ''}`
            });
            
            const data = await response.json();
            
            if (data.status === 'success') {
                // Update cart items
                document.querySelector('.produto_list_cart').innerHTML = renderCartItems(data.cartItems);
                
                // Update summary
                updateCartSummary({
                    subtotal: data.subtotal,
                    shipping: data.shipping,
                    total: data.total,
                    cartCount: data.cartCount
                });
                
                // Reattach event listeners to the new elements
                document.querySelector('.produto_list_cart').addEventListener('click', handleCartAction);
            }
        } catch (error) {
            console.error('Error:', error);
            location.reload();
        }
    }

    // Update cart summary
    function updateCartSummary(data) {
        document.querySelectorAll('.subtotal-value').forEach(el => {
            el.textContent = formatCurrency(data.subtotal);
        });
        document.querySelectorAll('.shipping-value').forEach(el => {
            el.textContent = formatCurrency(data.shipping);
        });
        document.querySelectorAll('.total-value').forEach(el => {
            el.textContent = formatCurrency(data.total);
        });
        document.querySelectorAll('.cart-count').forEach(el => {
            el.textContent = data.cartCount;
        });
    }

    // Initial event listener attachment
    document.querySelector('.produto_list_cart').addEventListener('click', handleCartAction);
});
</script>
<?php

include "footer.php";

?>