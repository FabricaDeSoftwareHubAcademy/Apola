<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../App/DB/Database.php';
// require_once __DIR__ . '/../../App/Controllers/ProductController.php';
require '../../App/config.inc.php';
require '../../App/Session/Login.php';

use App\Core\Config;
use App\DB\Database;

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

<<<<<<< HEAD
if(isset($_GET['id_produto'])){
    $id_produto = $_GET['id_produto'];
}
$produto = new Produto();
$result = $produto->buscarProdutoPorId($id_produto);


=======
>>>>>>> c917161 (*)
?>

    <main class="main2">
        <div class="comprar_produto">
            <section class="comprar_produto_top">
                <div class="conatiner_name_produto_cat">
                    <h6>
                        Home /
                        <!-- var_dump($product); exit; -->
                        <?= htmlspecialchars($product->getCategory()->getName()) ?>
                        <?= htmlspecialchars($product->getName()) ?>

                    </h6>
                </div>
                <div class="product-container">
                    <script src="../../src/JS/comprar_produto.js" defer></script>
                    <div class="product-thumb-container">
                        <div class="thumbnail-images">
<<<<<<< HEAD
                            <img src="<?php echo $result->imagem ?>" class="thumbnail" data-image="<?php echo $result->imagem ?>">
                        </div>
                        <div class="image-gallery">
                            <div class="image-gallery-urso">
                                <img src="<?php echo $result->imagem; ?>" id="main-image">
=======
                            <?php foreach ($product->getImageUrls() as $url): ?>
                                <img
                                    src="<?= htmlspecialchars($url) ?>"
                                    alt="<?= htmlspecialchars($product->getName()) ?>"
                                    class="thumbnail"
                                    data-image="<?= htmlspecialchars($url) ?>"
                                >
                            <?php endforeach; ?>
                        </div>
                        <div class="image-gallery">
                            <div class="image-gallery-urso">
                                <img
                                    src="<?= htmlspecialchars($product->getImageUrls()[0] ?? '') ?>"
                                    id="main-image"
                                >
>>>>>>> c917161 (*)
                            </div>
                            <div class="zoom-result" id="zoom-result"></div>
                        </div>
                    </div>
                    <script src="../../src/JS/comprar_produto.js"></script>
                    <div class="product-details">
                        <div class="product-details_left">
                            <div class="container_name_produto">
<<<<<<< HEAD
                                <h6><?php echo $result->nome ?></h6>
=======
                                <h6><?= htmlspecialchars($product->getName()) ?></h6>
>>>>>>> c917161 (*)
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
<<<<<<< HEAD
                                     
                                    <div style="background-color: <?php echo $result->cor; ?>" class="shape_cor_produto"></div>
                                    
=======
                                    <?php foreach ($product->getColors() as $colorHex): ?>
                                        <div class="shape_cor_produto" style="background: <?= htmlspecialchars($colorHex) ?>;"></div>
                                    <?php endforeach; ?>
>>>>>>> c917161 (*)
                                </div>
                            </div>
                            <div class="item_flex_produto">
                                <label>tamanho</label>
                                <div class="item_flex_cor_produto">
<<<<<<< HEAD
                                    <div class="shape_tamanho_produto">Altura <?php echo $result->altura; ?> cm</div>
                                    <div class="shape_tamanho_produto">Largura <?php echo $result->largura; ?> cm</div>
=======
                                    <?php foreach ($product->getSizes() as $size): ?>
                                        <div class="shape_tamanho_produto"><?= htmlspecialchars($size) ?></div>
                                    <?php endforeach; ?>
>>>>>>> c917161 (*)
                                </div>
                            </div>
                        </div>
                        <div class="product-details_right">
                            <div class="container_preco_produto">
<<<<<<< HEAD
                                <!-- <span class="preco_antigo_produto">Preço </span> -->
                                <span class="preco_novo_produto">R$ <div id="valor_produt"><?php echo $result->preco; ?></div></span>
=======
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
>>>>>>> c917161 (*)
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
                                                <!-- <a href="https://wa.me/<?= htmlspecialchars($storeWhatsapp) ?>">
                                                    <?= htmlspecialchars($storeWhatsapp) ?>
                                                </a> -->
                                            </div>
                                        </div>  
                                    </div>
                                </dialog>
                                <button class="btn_buy_produto" data-modal="modal-2">Comprar</button>
                                <script src="../src/JS/modal.js" defer></script>
                                <!-- First Product Section -->
                                <div class="container_buy_quant display_none_solo">
                                    <div class="menos_cart qty-control" data-target="quant_item_solo-<?= $product->getId() ?>">
                                        <i class="fa-solid fa-minus"></i>
                                    </div>
                                    <!-- Fixed ID: Use hyphen instead of space -->
                                    <div id="quant_item_solo-<?= $product->getId() ?>" class="quant_cart_solo">1</div>
                                    <div class="mais_cart qty-control" data-target="quant_item_solo-<?= $product->getId() ?>">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                </div>

                                <!-- Add to Cart Button (First Section) -->
                                <button class="btn_bag_produto" 
                                        data-action="add" 
                                        data-id="<?= $product->getId() ?>"
                                        data-qty-target="quant_item_solo-<?= $product->getId() ?>">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </button>
<<<<<<< HEAD
                            </div>
                            <div class="container_buy_quant display_none_solo">
                                <div id='sub_item_solo' class="menos_cart"><i class="fa-solid fa-minus"></i></div>
                                <div  id='quant_item_solo' class="quant_cart_solo">1</div>
                                <div  id='sum_item_solo' class="mais_cart"><i class="fa-solid fa-plus"></i></div>
                            </div>
                        </div>
        
                    </div>
                    <div class="container_buy_produto2  ">
                        <div class="container_buy_buy none_display">
                            <button class="btn_buy_produto" data-modal="modal-2"><i class="fa-solid fa-bag-shopping"></i> Comprar</button>
                            <button class="btn_bag_produto"><i class="fa-solid fa-bag-shopping"></i></button>
                        </div>
                        <div class="container_buy_quant none_display">
                                <div id='sub_item_solo2' class="menos_cart"><i class="fa-solid fa-minus"></i></div>
                                <div  id='quant_item_solo2' class="quant_cart_solo">1</div>
                                <div  id='sum_item_solo2' class="mais_cart"><i class="fa-solid fa-plus"></i></div>
                            </div>
                    </div>
                    

                </div>
            </section>
            <section class="comprar_produto_medium">
                <div class="descricao_produto_solo_cont">
                    <div class="descricao_produto_solo_cont_header">
                        <div class="title_produto_solo_item">
                            Descrição <!-- <i class="fa-solid fa-chevron-down"></i> -->
                        </div>
                        <div  id="icone_produto_solo_item" class="icone_produto_solo_item">
                            <i class="fa-solid fa-chevron-up"></i>
                        </div>
                    </div>
                    <div class="descricao_produto_solo_cont_body">
                       <div class="descricao_solo"><?php echo $result->descricao ?></div>
                    </div>
                    <div class="shape_solo"></div>
                </div>
                <div class="descricao_produto_solo_cont">
                    <div class="descricao_produto_solo_cont_header">
                        <div class="title_produto_solo_item">
                            Avaliação <!-- <i class="fa-solid fa-chevron-down"></i> -->
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
=======
                            </section>
                            <section class="comprar_produto_medium">
                                <div class="descricao_produto_solo_cont">
                                    <div class="descricao_produto_solo_cont_header">
                                        <div class="title_produto_solo_item">
                                            Descrição <i class="fa-solid fa-chevron-down"></i>
                                        </div>
                                        <div  id="icone_produto_solo_item" class="icone_produto_solo_item">
                                            <i class="fa-solid fa-chevron-up"></i>
                                        </div>
                                    </div>
                                    <div class="descricao_produto_solo_cont_body">
                                    <div class="descricao_solo">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis, quasi illum molestias exercitationem rerum cum illo maxime cupiditate labore nisi. Optio perferendis, velit ipsam reprehenderit sequi repellat consequatur earum tempore! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe, beatae, blanditiis rerum voluptatem sit vero incidunt non odio debitis cum mollitia voluptates aperiam reprehenderit, quaerat esse deserunt expedita. Ut, voluptatum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem illo asperiores in cupiditate. Possimus alias id quis aliquid perferendis quia cupiditate voluptatem tenetur iure. Tempora consectetur odio excepturi obcaecati praesentium? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus molestiae, officiis ex mollitia, eaque rerum debitis explicabo dicta minus incidunt ipsam quaerat non perspiciatis possimus exercitationem optio facilis qui ad. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia sint aliquam aliquid excepturi, laborum molestiae quia voluptas dolorem placeat fuga porro! Obcaecati debitis distinctio dolorum quis, repellat recusandae alias maiores?  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate, maxime vitae. Quam praesentium ex molestiae, nobis obcaecati pariatur veritatis id commodi architecto voluptatibus sapiente error corrupti ab provident soluta aliquid?</div>
                                    </div>
                                    <div class="shape_solo"></div>
>>>>>>> c917161 (*)
                                </div>
                                <div class="descricao_produto_solo_cont">
                                    <div class="descricao_produto_solo_cont_header">
                                        <div class="title_produto_solo_item">
                                            Avaliação <i class="fa-solid fa-chevron-down"></i>
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
                                                </div>
                                                <div class="modal_body">
                                                <h5 class="title_modal_zap">Avaliação</h5>
                                                <div class="text_modal_zap">Gostou do produto? Sua opinião é essencial para que possamos continuar oferecendo a melhor experiência para nossos clientes. </div>
                                                <div class="conatiner_item_modal_link_zap">
                                                    <form action="">
                                                        <div class="item_star_modal">
                                                            <div class="conatiner_comentario_star_modal">
                                                                <div class="stars">
                                                                    <input type="checkbox" id="star1" class="star-checkbox">
                                                                    <label for="star1" class="star">&#9733;</label>
                    
                                                                    <input type="checkbox" id="star2" class="star-checkbox">
                                                                    <label for="star2" class="star">&#9733;</label>
                    
                                                                    <input type="checkbox" id="star3" class="star-checkbox">
                                                                    <label for="star3" class="star">&#9733;</label>
                                                                    
                                                                    <input type="checkbox" id="star4" class="star-checkbox">
                                                                    <label for="star4" class="star">&#9733;</label>
                    
                                                                    <input type="checkbox" id="star5" class="star-checkbox">
                                                                    <label for="star5" class="star">&#9733;</label>
                                                                </div>
                                                                <!-- <i class="fa-solid fa-star " ></i>
                                                                <i class="fa-solid fa-star" ></i>
                                                                <i class="fa-solid fa-star" ></i>
                                                                <i class="fa-solid fa-star" ></i> -->
                                                            </div>
                                                            <textarea name="" id="" cols="30" rows="10"></textarea>
                                                            <div class="container_avalirar_btn">
                                                                <button class="avaliar_btn">Comentar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>  
                                                </div>
                                            </dialog>
                                            <div class="comentario_item">
                                                <div class="name_comentario">Lucas Nogueira</div>
                                                <div class="conatiner_comentario_star">
                                                    <i class="fa-solid fa-star " id='star_active'></i>
                                                    <i class="fa-solid fa-star" id='star_active'></i>
                                                    <i class="fa-solid fa-star" id='star_active'></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <div class="comentario_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus tempore provident animi iusto dignissimos at beatae eum aspernatur doloribus hic deserunt, voluptatibus consectetur! Explicabo incidunt enim neque magni quod quae.
                                                </div>  
                                            </div>
                                            <div class="shape_comentario"></div>
                                            <div class="comentario_item">
                                                <div class="name_comentario">Amanda Neto</div>
                                                <div class="conatiner_comentario_star">
                                                    <i class="fa-solid fa-star " id='star_active'></i>
                                                    <i class="fa-solid fa-star" id='star_active'></i>
                                                    <i class="fa-solid fa-star" id='star_active'></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <div class="comentario_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore obcaecati architecto eaque accusantium tempore doloribus saepe ratione fugit sed quisquam libero, ea consequatur, ad nostrum dolores officia repellendus deserunt recusandae.
                                                </div>  
                                            </div>
                                            <div class="shape_comentario"></div>
                                            <div class="comentario_item">
                                                <div class="name_comentario">Larissa Ribeiro</div>
                                                <div class="conatiner_comentario_star">
                                                    <i class="fa-solid fa-star " id='star_active'></i>
                                                    <i class="fa-solid fa-star" id='star_active'></i>
                                                    <i class="fa-solid fa-star" id='star_active'></i>
                                                    <i class="fa-solid fa-star"  id='star_active'></i>
                                                </div>
                                                <div class="comentario_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore eos natus eius neque sint sed maxime id, quo amet corrupti ipsa ut vitae sunt distinctio quis dolor? Est, distinctio dignissimos?
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shape_solo"></div>
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

    // Quantity controls
    document.querySelectorAll('.qty-control').forEach(control => {
        control.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.dataset.target;
            const qtyDisplay = document.getElementById(targetId);
            if (!qtyDisplay) return;

            let currentQty = parseInt(qtyDisplay.textContent) || 1;
            currentQty = this.classList.contains('menos_cart') 
                ? Math.max(1, currentQty - 1) 
                : currentQty + 1;
            
            qtyDisplay.textContent = currentQty;
        });
    });

    // Add to cart functionality
    document.querySelectorAll('.btn_bag_produto').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const productId = this.dataset.id;
            const qty = parseInt(document.getElementById(this.dataset.qtyTarget)?.textContent) || 1;

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
                    
                    // Show success message
                    // alert('Produto adicionado ao carrinho!');
                } else {
                    alert(data.message || 'Erro ao adicionar ao carrinho');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Erro na comunicação com o servidor');
            }
        });
    });
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

    <script>

    // document.addEventListener('DOMContentLoaded', () => {
    //     const bagBtn = document.querySelector('.btn_bag_produto');
    //     bagBtn.addEventListener('click', async () => {
    //         const productId = bagBtn.dataset.id;
    //         const quantity = 1; // pode ser dinâmico depois

    //         try {
    //         // Faz a requisição para seu PHP enviando os dados
    //         const resp = await fetch(`comprar_produto.php?id=${productId}&quantity=${quantity}`, {
    //             method: 'GET', // ou POST se preferir
    //             headers: {
    //             'Content-Type': 'application/json'
    //             }
    //         });

    //         // Converte a resposta para JSON
    //         const json = await resp.json();

    //         if (json.success) {
    //             alert('Produto adicionado ao carrinho!');
    //         } else {
    //             alert('Não foi possível adicionar ao carrinho.');
    //         }

    //         } catch (err) {
    //         console.error(err);
    //         alert('Erro-1 de rede ao adicionar ao carrinho.');
    //         }
    //     });
    // });


    </script>

    <script>
// document.addEventListener('DOMContentLoaded', () => {
//     // Handle add to cart button
//     const bagBtn = document.querySelector('.btn_bag_produto');
//     if (bagBtn) {
//         bagBtn.addEventListener('click', () => {
//             const productId = bagBtn.dataset.id;
//             const quantity = parseInt(document.getElementById('quant_item_solo').textContent) || 1;
            
//                 fetch('add_to_cart.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify({
//                     id: productId,
//                     qty: quantity
//                 })
//                 });                
//                 .then(res => res.json())
//                 .then(json => {
//                     if (json.status === 'success') {
//                         alert('Produto adicionado ao carrinho!');
//                     } else {
//                         alert('Erro-2 ao adicionar ao carrinho.');
//                     }
//                 })
//                 .catch(() => alert('Erro de rede'));
//         });
//     }

    // // Handle quantity buttons
    // const qtyElements = {
    //     minus: ['sub_item_solo', 'sub_item_solo2'],
    //     display: ['quant_item_solo', 'quant_item_solo2'],
    //     plus: ['sum_item_solo', 'sum_item_solo2']
    // };

    // // Attach event listeners to all quantity controls
    // Object.keys(qtyElements).forEach(type => {
    //     qtyElements[type].forEach(id => {
    //         const el = document.getElementById(id);
    //         if (el) {
    //             el.addEventListener('click', () => updateQuantity(type, id));
    //         }
    //     });
    // });

    // function updateQuantity(type, sourceId) {
    //     // Determine which display element to update
    //     const displayId = sourceId.includes('solo2') ? 'quant_item_solo2' : 'quant_item_solo';
    //     const displayEl = document.getElementById(displayId);
        
    //     if (!displayEl) return;
        
    //     let currentQty = parseInt(displayEl.textContent) || 1;
        
    //     if (type === 'minus' && currentQty > 1) {
    //         currentQty--;
    //     } else if (type === 'plus') {
    //         currentQty++;
    //     }
        
    //     displayEl.textContent = currentQty;
        
    //     // Sync both displays
    //     const otherDisplayId = displayId === 'quant_item_solo' ? 'quant_item_solo2' : 'quant_item_solo';
    //     const otherDisplayEl = document.getElementById(otherDisplayId);
    //     if (otherDisplayEl) {
    //         otherDisplayEl.textContent = currentQty;
    //     }
    // }
</script>

<?php

include './footer.php';
?>
