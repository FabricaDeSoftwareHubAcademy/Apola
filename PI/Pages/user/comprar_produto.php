<?php
// /home/felix/Desktop/Apola/PI/Pages/user/comprar_produto.php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../App/config.inc.php';
require_once __DIR__ . '/../../App/Session/Login.php';

// require_once(__DIR__ . '/../DB/Database.php');

use App\DB\Database;
use App\Core\Config;

// Erros ativados para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicializa config (carrega .env etc)
Config::initialize();

// Conecta ao banco
$database = new Database();
$pdo = $database->conecta();

// Pega o ID do produto da URL e valida
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($productId <= 0) {
    die("ID de produto inválido");
}

// Inicializa model e controller (supondo que ProductModel recebe o PDO)
$productModel = new App\Entity\ProductModel($pdo);
// $productController = new App\Controllers\ProductController($productModel);

// Busca o produto
$product = $productModel->getProductById($productId);
if (!$product) {
    die("Produto não encontrado");
}

// Agora chama a view (você pode adaptar para incluir cabeçalho, navbar, footer, etc)

// Exemplo simples de exibição do produto
// echo "<h1>{$product['nome']}</h1>";
// echo "<p>Preço: R$ {$product['preco']}</p>";
// echo "<p>Descrição: {$product['descricao']}</p>";
// echo "<p>Cores: {$product['cor']}</p>";
// echo "<p>Tamanhos: {$product['tamanho']}</p>";

// Pode colocar aqui o botão de "Adicionar ao carrinho", etc

// include __DIR__ . '/footer.php';

// var_dump($productData);
// var_dump($_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
// exit;

include "header.php";

$result = Login::RequireLogout();

if($result){
    include 'navbar_logado.php';

}else{
    include 'navbar_deslogado.php';
}

if(isset($_GET['id_produto'])){
    $id_produto = $_GET['id_produto'];
}
$produto = new Produto();
$result = $produto->buscarProdutoPorId($id_produto);

?>

    <main class="main2">
        <div class="comprar_produto">
            <section class="comprar_produto_top">
                <div class="conatiner_name_produto_cat">
                    <h6>
                        Home /
                        <?= htmlspecialchars($product->getCategory()->getName()) ?>
                        <?= htmlspecialchars($product->getName()) ?>
                    </h6>
                </div>
                <div class="product-container">
                    <script src="../../src/JS/comprar_produto.js" defer></script>
                    <div class="product-thumb-container">
                        <div class="image-gallery">
                            <div class="image-gallery-urso">
                                <?php if (!empty($product->getImageUrls())): ?>
                                    <img 
                                        src="<?= htmlspecialchars($product->getImageUrls()[0]) ?>" 
                                        id="main-image"
                                    >
                                <?php endif; ?>
                            </div>
                            <div class="zoom-result" id="zoom-result"></div>
                        </div>
                    </div>
                    <script src="../../src/JS/comprar_produto.js"></script>
                    <div class="product-details">
                        <div class="product-details_left">
                            <div class="container_name_produto">
                                <h6><?= htmlspecialchars($product->getName()) ?></h6>
                                <i class="fa-solid fa-heart"></i>
                            </div>
                            <div class="container_avaliacao_produto">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <div class="item_flex_produto">
                                <label>Cor</label>
                                <div class="item_flex_cor_produto">
                                    <?php foreach ($product->getColors() as $colorHex): ?>
                                        <div class="shape_cor_produto" style="background: <?= htmlspecialchars($colorHex) ?>;"></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="item_flex_produto">
                                <label>tamanho</label>
                                <div class="item_flex_cor_produto">
                                    <?php foreach ($product->getSizes() as $size): ?>
                                        <div class="shape_tamanho_produto"><?= htmlspecialchars($size) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="product-details_right">
                            <div class="container_preco_produto">
                                <?php if ($product->getOriginalPrice()): ?>
                                    <span class="preco_antigo_produto">
                                        De R$ <?= number_format($product->getOriginalPrice(), 2, ',', '.') ?>
                                    </span>
                                <?php endif; ?>
                                <span class="preco_novo_produto">
                                    R$<div id="valor_produt">
                                        <?= number_format($product->getPrice(), 2, ',', '.') ?>
                                    </div>
                                </span>
                            </div>
                            
                            <div class="container_cep_produto">
                                <div class="item_flex_produto">
                                    <label>Cep</label>
                                    <div class="cep_container_input">
                                        <input type="text">
                                        <button class="btn_cep_produto"><i class="fa-solid fa-truck"></i></button>
                                    </div>
                                </div>
                            </div> 
                            <div class="container_buy_produto none_display">
                                <dialog id="modal-2">
                                    <div class="modal_header">
                                        <button class="close-modal" data-modal="modal-2">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <div class="modal_body">
                                        <h5 class="title_modal_zap">Produto Comprado!</h5>
                                        <div class="text_modal_zap">
                                            Recebemos seu pedido e ele está em processo de análise. Em breve, você será notificado sobre a aprovação. 
                                            Fique atento às atualizações no seu e-mail ou painel de pedidos. Dúvidas entre em contato.
                                        </div>
                                        <div class="conatiner_item_modal_link_zap">
                                            <div class="item_modal_link_zap">
                                                <i class="fa-brands fa-whatsapp"></i>
                                            </div>
                                        </div>  
                                    </div>
                                </dialog>
                                <button class="btn_buy_produto" data-modal="modal-2">Comprar</button>
                                <script src="../src/JS/modal.js" defer></script>
                                <!-- Single Quantity Control Section -->
<div class="container_buy_quant">
    <div class="menos_cart qty-control" data-target="quant_item_solo">
        <i class="fa-solid fa-minus"></i>
    </div>
    <div id="quant_item_solo" class="quant_cart_solo">1</div>
    <div class="mais_cart qty-control" data-target="quant_item_solo">
        <i class="fa-solid fa-plus"></i>
    </div>
</div>

<!-- Add to Cart Button -->
<button class="btn_bag_produto" 
        data-action="add" 
        data-id="<?= $product->getId() ?>"
        data-qty-target="quant_item_solo">
    <i class="fa-solid fa-bag-shopping"></i>
</button>
                    

                </div>
            </section>
            <section class="comprar_produto_medium">
                <div class="descricao_produto_solo_cont">
                    <div class="descricao_produto_solo_cont_header">
                        <div class="title_produto_solo_item">
                            Descrição
                        </div>
                        <div  id="icone_produto_solo_item" class="icone_produto_solo_item">
                            <i class="fa-solid fa-chevron-up"></i>
                        </div>
                    </div>
                    <div class="descricao_produto_solo_cont_body">
                    <div class="descricao_solo"><?= htmlspecialchars($product->getDescription()) ?></div>
                    </div>
                    <div class="shape_solo"></div>
                </div>
                <div class="descricao_produto_solo_cont">
                    <div class="descricao_produto_solo_cont_header">
                        <div class="title_produto_solo_item">
                            Avaliação
                        </div>
                        <div id="icone_produto_solo_item" class="icone_produto_solo_item">
                            <i class="fa-solid fa-chevron-up"></i>
                        </div>
                    </div>
                    <div class="descricao_produto_solo_cont_body">
                        <div class="container_comentarios">
                            <div class="conatiner_comentar_btn">
                                <button data-modal="modal-1" class ="btn_comentar open-modal">Avaliar</button>
                            </div>
                            <dialog id="modal-1">
                                <div class="modal_header">
                                <button class="close-modal" data-modal="modal-1"><i class="fa-solid fa-xmark"></i></button>
                            </section>
                            <section class="comprar_produto_medium">
                                <!-- ... rest of the evaluation section ... -->
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>

document.addEventListener('DOMContentLoaded', function() {
    // Image gallery functionality
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('main-image');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            mainImage.src = this.dataset.image;
        });
    });

    // Quantity controls - single source of truth
    let currentQuantity = 1;
    const quantityElement = document.getElementById('quant_item_solo');
    
    document.querySelectorAll('.qty-control').forEach(control => {
        control.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (this.classList.contains('menos_cart')) {
                currentQuantity = Math.max(1, currentQuantity - 1);
            } else {
                currentQuantity += 1;
            }
            
            // Update display
            quantityElement.textContent = currentQuantity;
            
            // Update price if needed
            updatePrice(currentQuantity);
        });
    });

    // Add to cart functionality
    document.querySelectorAll('.btn_bag_produto').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const productId = this.dataset.id;
            const qty = currentQuantity; // Always use the current quantity
            
            try {
                const response = await fetch('/PI/Pages/user/cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=add&id=${productId}&qty=${qty}`
                });

                const data = await response.json();
                
                if (data.status === 'success') {
                    // Update cart count
                    document.querySelectorAll('.cart-count').forEach(el => {
                        el.textContent = data.cartCount;
                    });
                    
                    // Show success message (consider using a toast instead of alert)
                    console.log('Produto adicionado ao carrinho!');
                } else {
                    console.error(data.message || 'Erro ao adicionar ao carrinho');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Erro na comunicação com o servidor');
            }
        });
    });

    // Price update function
    function updatePrice(qty) {
        const unitPrice = <?= $product->getPrice() ?>;
        const totalPrice = unitPrice * qty;
        document.querySelector('.preco_novo_produto').textContent = 
            'R$ ' + totalPrice.toFixed(2).replace('.', ',');
    }
});
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const openButtons = document.querySelectorAll('.open-modal');
    const closeButtons = document.querySelectorAll('.close-modal');

    openButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const modalId = e.currentTarget.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.showModal();
            }
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const modalId = e.currentTarget.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.close();
            }
        });
    });

    // Novo código para o botão de "Comprar"
    const buyButton = document.querySelector('.btn_buy_produto');
    const modal2 = document.getElementById('modal-2');
    
    if (buyButton && modal2) {
        buyButton.addEventListener('click', () => {
            modal2.showModal(); // Abre o modal de pedido enviado
        });
    }
});

    </script>

<?php

include './footer.php';
?>
