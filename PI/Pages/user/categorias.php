<?php


require '../../App/config.inc.php';

require '../../App/Session/Login.php';

include "head.php";


$result = Login::IsLogedCliente();


if($result){
    include 'navbar_logado.php';

}else{
    include 'navbar_deslogado.php';

}


if(isset($_GET['id_categoria'])){
    $id_categoria = $_GET['id_categoria'];
}

$produto = new Produto();
$produtos = $produto->buscarProduto("categoria_id_categoria = ".$id_categoria);

// if($produtos)



?>
    <main  class="main2">
        <div class="container_categorias">

            <aside class="top_categoria_mobile">
                <div class="shape_categoria_top"></div>
                    <div class="container_text_top_categoria">
                        <div class="item_text_top_cat">2016 produtos encontrados.</div>
                        <i  class="fa-solid fa-filter"></i>
                        <div id="btn_filtro" class="item_text_top_cat">filtrar</div>
                    </div>
                <div class="shape_categoria_top"></div>
            </aside>
            <div class="top_mobile_filtro_open" id="open_filtro">
                <div class="accordion_mobile_filtro">
                    <button class="accodion-header_mobile">
                        <h6 class="name_item_filtro_cat">
                            Material
                        </h6>
                        <i class="fa-solid fa-chevron-down arrow"></i>
                    </button>
                    
                    <div class="accordion-body_mobile">
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">Cachepô Crochê</h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">Cachepô Crochê</h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">Cachepô Crochê</h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">Cachepô Crochê</h6>
                        </div>
                    </div>
                </div>
                <div class="accordion_mobile_filtro">
                    <button class="accodion-header_mobile">
                        <h6 class="name_item_filtro_cat">
                            Avaliação
                        </h6>
                        <i class="fa-solid fa-chevron-down arrow"></i>
                    </button>
                    
                    <div class="accordion-body_mobile">
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="star_filtro_cat">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="star_filtro_cat">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star a"></i>
                            </h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="star_filtro_cat">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star a"></i>
                                <i class="fa-solid fa-star a"></i>
                            </h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="star_filtro_cat">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star a"></i>
                                <i class="fa-solid fa-star a"></i>
                                <i class="fa-solid fa-star a"></i>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="accordion_mobile_filtro">
                    <button class="accodion-header_mobile">
                        <h6 class="name_item_filtro_cat">
                            Tamanho
                        </h6>
                        <i class="fa-solid fa-chevron-down arrow"></i>
                    </button>
                    
                    <div class="accordion-body_mobile">
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">10 cm</h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">15 cm</h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">20 cm</h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">25 cm</h6>
                        </div>
                        <div class="flex_filtro_cat_mobile">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat_mobile">30 cm</h6>
                        </div>
                    </div>
                </div>
                <div class="container_btn_mobile_filtro">
                    <button >Aplicar</button>
                </div>
            </div>


            <aside class="left_categoria">
                <!-- <div class="container_title_left_categoria">
                    <h6 class="title_left_categoria">Home</h6>
                    <h6 class="title_left_categoria">/</h6>
                    <h6 class="title_left_categoria">Amigurumi</h6>
                </div> -->
                <div class="conatiner_input_preco">
                    <h6 class="title_left_categoria  title_left_categoria_mobile">Faixa de Preço</h6>
                    <input type="range" id="preco" name="preco" min="0" max="1000" step="10" oninput="document.getElementById('rangeValue').innerText = this.value">
                    <div class="range-value">R$ <span id="rangeValue">500</span></div>
                </div>
                <div class="container_left_filtro">
                    <div class="item_filtro_cat">
                        <div class="title_filtro_cat">Material</div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">Cachepô Crochê</h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">Cachepô Crochê</h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">Cachepô Crochê</h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">Cachepô Crochê</h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">Cachepô Crochê</h6>
                        </div>
                        <span class="linha_quebra_categoria"></span>
                    </div>
                    <div class="item_filtro_cat">
                        <div class="title_filtro_cat">Avaliação</div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="star_filtro_cat">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="star_filtro_cat">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star a"></i>
                            </h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input  type="checkbox" name="" id="">
                            <h6 class="star_filtro_cat">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star a"></i>
                                <i class="fa-solid fa-star a"></i>
                            </h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="star_filtro_cat">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star a"></i>
                                <i class="fa-solid fa-star a"></i>
                                <i class="fa-solid fa-star a"></i>
                            </h6>
                        </div>
                        <span class="linha_quebra_categoria"></span>
                    </div>
                    <div class="item_filtro_cat">
                        <div class="title_filtro_cat">Tamanho</div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">10 cm</h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">15 cm</h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">20 cm</h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">25 cm</h6>
                        </div>
                        <div class="flex_filtro_cat">
                            <input type="checkbox" name="" id="">
                            <h6 class="name_filtro_cat">30 cm</h6>
                        </div>
                    </div>
                </div>
                
            </aside>

            <aside class="right_categoria">
                <div class="container_filtro_right">
                    <select name="" id="">
                        <option value="">Mais Vendidos</option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </div>
                <div class="wrap__filtro_right">
                    <!-- <a  style ="text-decoration:none;"class="link_produto_home" href="./comprar_produto.php"> -->
                    <?php
                    foreach ($produtos as $prod): 
                        if($prod->status_produto === 'a'):
                    ?>
                        <div class="card_produto" style="max-width: 40%;">
                            <div class="icon_favorite">
                                <label class="checkbox-heart">
                                    <input class="input-check" type="checkbox"
                                        data-status="<?= $prod->status_favoritos ?? '' ?>"
                                        data-id="<?= $prod->id_produto ?>"
                                        <?= !empty($prod->status_favoritos) ? 'checked' : '' ?>>
                                    <i class="fa-solid fa-heart"></i>
                                </label> 
                            </div>
                            <div class="img_content_produto">
                                <img src="<?= $prod->imagem ?>" alt="<?= htmlspecialchars($prod->nome) ?>">
                            </div>
                            <div class="conteudo_card">
                                <div class="nome_card_produto"><?= htmlspecialchars($prod->nome) ?></div>
                                <div class="content_star_icon">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <i class="fa-solid fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                <div class="preco_card_produto">R$ <?= number_format($prod->preco, 2, ',', '.') ?></div>
                                <div class="btn_content_card_produto">
                                    <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i></div>
                                    <a href="./comprar_produto.php?id_produto=<?= $prod->id_produto ?>" class="btn_buy_card">Comprar</a>
                                </div>
                            </div>
                        </div>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    <!-- <a  style ="text-decoration:none;"class="link_produto_home" href="./comprar_produto.php">
                    <div class="card_produto">
                        <div class="icon_favorite"><i class="fa-solid fa-heart"></i></div>
                        <div class="img_content_produto">
                            <img src="../../src/imagens/card_produto/IMG1-Produto.png" alt="">
                        </div>
                        <div class="conteudo_card">
                            <div class="nome_card_produto">Amigurmi Raposa</div>
                            <div class="content_star_icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="preco_card_produto">R$ 50,89</div>
                            <div class="btn_content_card_produto">
                                <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i></div>
                                <div class="btn_buy_card">Comprar</div>
                            </div>
                        </div>
                    </div>
                    <div class="card_produto">
                    <a  style ="text-decoration:none;"class="link_produto_home" href="./comprar_produto.php">
                        <div class="icon_favorite"><i class="fa-solid fa-heart"></i></div>
                        <div class="img_content_produto">
                            <img src="../../src/imagens/card_produto/IMG1-Produto.png" alt="">
                        </div>
                        <div class="conteudo_card">
                            <div class="nome_card_produto">Amigurmi Raposa</div>
                            <div class="content_star_icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="preco_card_produto">R$ 50,89</div>
                            <div class="btn_content_card_produto">
                                <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i></div>
                                <div class="btn_buy_card">Comprar</div>
                            </div>
                        </div>
                    </div>
                    <div class="card_produto">
                    <a  style ="text-decoration:none;"class="link_produto_home" href="./comprar_produto.php">
                        <div class="icon_favorite"><i class="fa-solid fa-heart"></i></div>
                        <div class="img_content_produto">
                            <img src="../../src/imagens/card_produto/IMG1-Produto.png" alt="">
                        </div>
                        <div class="conteudo_card">
                            <div class="nome_card_produto">Amigurmi Raposa</div>
                            <div class="content_star_icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="preco_card_produto">R$ 50,89</div>
                            <div class="btn_content_card_produto">
                                <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i></div>
                                <div class="btn_buy_card">Comprar</div>
                            </div>
                        </div>
                    </div>
                    <div class="card_produto">
                        <div class="icon_favorite"><i class="fa-solid fa-heart"></i></div>
                        <div class="img_content_produto">
                            <img src="../../src/imagens/card_produto/IMG1-Produto.png" alt="">
                        </div>
                        <div class="conteudo_card">
                            <div class="nome_card_produto">Amigurmi Raposa</div>
                            <div class="content_star_icon">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="preco_card_produto">R$ 50,89</div>
                            <div class="btn_content_card_produto">
                                <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i></div>
                                <div class="btn_buy_card">Comprar</div>
                            </div>
                        </div>
                    </div> -->

                </div>



            </aside>





        </div>



        
    </main>
<?php

include "footer.php";



?>