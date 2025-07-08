<?php

require '../../App/config.inc.php';

require '../../App/Session/Login.php';

include "head.php";

if (Login::IsLogedCliente()) {
    include 'navbar_logado.php';
    echo '<script>sessionStorage.setItem("idcliente",'. $_SESSION['cliente']['id_cliente'] .')</script>';
    

} 
else {
    include 'navbar_deslogado.php';
    echo'<script>sessionStorage.clear();</script>';

}


$banner = new Banner();


$bannerPrincipalPosicao1 = $banner->getBannerForPosicao('banners_principais',1);


$bannerPrincipalPosicao2 = $banner->getBannerForPosicao('banners_principais',2);
$bannerPrincipalPosicao3 = $banner->getBannerForPosicao('banners_principais',3);

$bannerSecundarioPosicao1 = $banner->getBannerForPosicao('banners_secundarios',1);

$bannerPromocionalPosicao1  = $banner->getBannerForPosicao('banners_promocionais',1);
$bannerPromocionalPosicao2  = $banner->getBannerForPosicao('banners_promocionais',2);
$bannerPromocionalPosicao3  = $banner->getBannerForPosicao('banners_promocionais',3);







$produtosAleatorios = Produto::buscarProdutoAleatorio();



// print_r($produtosAleatorios);
// exit;


$categorias = Categoria::buscarCategoriaLimit('RAND()',null,3);
print_r($categorias);
$categoriasAll =  Categoria::buscarCategoriaLimit(null, 'BY RAND()',6);


$categoriaArray = array();

foreach ($categorias as $categoria) {

    array_push($categoriaArray, $categoria->nome);

}

$produtoCategoria1 = Produto::buscarProdutoCategoria($categoriaArray[0]);
$produtoCategoria2 = Produto::buscarProdutoCategoria($categoriaArray[1]);
$produtoCategoria3 = Produto::buscarProdutoCategoria($categoriaArray[2]);






?>

<!-- Started new branch 25 -->



    <main  class="main2">
        <!-- INICIO BANNER PRINCIPAL -->
             
        <!-- <section id="carouselExampleControls" class="carousel slide carrosel_pc" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="<?= $bannerPrincipalPosicao1->caminho; ?>" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?= $bannerPrincipalPosicao2->caminho; ?>" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="<?= $bannerPrincipalPosicao3->caminho; ?>" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </section> -->
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
        <!-- FIM BANNER PRINCIPAL -->




        <!-- INICIO BANNER MENU -->
        <!-- <div class="mySwiperMenu carrosel_menu">
            <div class="swiper-wrapper swiper-wrapper_menu">
              <div class="swiper-slide"><img src="../../src/imagens/img_banner_menu/1.png" alt=""></div>
              <div class="swiper-slide"><img src="../../src/imagens/img_banner_menu/2.png" alt=""></div>
              <div class="swiper-slide"><img src="../../src/imagens/img_banner_menu/3.png" alt=""></div>
            </div>
            <div class="swiper-pagination" style="--swiper-pagination-color:rgb(255, 255, 255);"></div>
        </div> -->



        <!-- INICIO CARDS CATEGORIA -->
        <section class="cards_cartegoria">
                <div class="content_cards_categoria">
                    <div class="Title_card_produto Title_card_categoria">Categorias</div>
                    <ul class="list_cards_categoria">
                        <?php

                        foreach ($categoriasAll as $categoria) {
                            echo'
                            <li class="item_cards_categoria">
                                <a class="link_cards_categoria" href="./categorias.php?id_categoria='. $categoria->id_categoria .'">
                                    <div class="img_content_categoria">
                                        <img src="'.$categoria->imagem.'" alt="">
                                    </div>
                                    <div class="text_cards_categoria">'.$categoria->nome.'</div>
                                </a>
                            </li>

                            ';


                        }



                        ?>    
                    </ul>
                </div> 
        </section>
        <!-- FIM CARDS CATEGORIA -->  
        
    


        <!-- INICIO 1* CARDS PRODUTOS -->
        <section class="card_produtos">
        <div class="swiper">
            <div class="Title_card_produto">Destaques</div>
            <div class="btn_card_produto">
                <div class="btn_prev_card"><i class="fa-solid default_btn_icon_card fa-chevron-left"></i></div>
                <div class="btn_next_card"><i class="fa-solid default_btn_icon_card fa-chevron-right"></i></div>
            </div>
            <div class="swiper-wrapper">

                <?php

                    foreach ($produtosAleatorios as $produto) {
                        echo '
                            <div class="swiper-slide card_produto">
                                <div class="icon_favorite">
                                    <label class="checkbox-heart">
                                        <input class="input-check" type="checkbox" data-status="'.$produto['status_favoritos'] .'" data-id="'.$produto['id_produto'].'" '.($produto['status_favoritos'] ? 'checked' : '').'>
                                        <i class="fa-solid fa-heart"></i>
                                    </label> 
                                </div>
                                <div class="img_content_produto">
                                    <img src="'.$produto['imagem'].'" alt="">
                                </div>
                                <div class="conteudo_card">
                                    <div class="nome_card_produto">'.htmlspecialchars($produto['produto_nome']).'</div>
                                    <div class="content_star_icon">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="preco_card_produto">R$ '.number_format($produto['preco'], 2, ',', '.').'</div>
                                    <div class="btn_content_card_produto">
                                        <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i></div>
                                        <a href="./comprar_produto.php?id_produto='. $produto['id_produto'] .'"class="btn_buy_card">Comprar</a>
                                    </div>
                                </div>
                            </div>
                        ';
                    }


                ?>
            </div>
        </div>
    </section>
        <!-- FIM 1* CARDS PRODUTOS -->





        <!-- INICIO AREA PROMOCIONAL -->
          <section class="area_promocional">
            <div class="content_area_promocional">
                <div class="icon_promocional">
                    <div class="img_content_promocional">
                        <img src="../../src/imagens/img_promocional/bolsa-de-compras.png" alt="">
                    </div>
                    <span class="texto_promocional">Pedido Personalizado</span>
                </div>
                <div class="icon_promocional">
                    <div class="img_content_promocional">
                        <img src="../../src/imagens/img_promocional/mao.png" alt="">
                    </div>
                    <span class="texto_promocional">Feito á mão</span>
                </div>
                <div class="icon_promocional">
                    <div class="img_content_promocional">
                        <img src="../../src/imagens/img_promocional/brasil.png" alt="">
                    </div>
                    <span class="texto_promocional">100% Nacional</span>
                </div>
            </div>
        </section>
        <!-- FIM AREA PROMOCIONAL -->




        <!-- INICIO BANNER SECUNDARIO -->
        <section class="banners_secudarios">
            <img src="<?= $bannerSecundarioPosicao1->caminho;?> " alt="">
        </section>
        <!-- FIM BANNER SECUNDARIO -->




        <!-- INICIO 2* CARDS PRODUTOS -->
        <section class="card_produtos">
            <div class="swiper">
                <div class="Title_card_produto">  <?php print_r($categoriaArray[0]) ?>  </div>
                <div class="btn_card_produto">
                    <div class="btn_prev_card"><i class="fa-solid default_btn_icon_card fa-chevron-left"></i></div>
                    <div class="btn_next_card"><i class="fa-solid default_btn_icon_card fa-chevron-right"></i></div>
                </div>
                <div class="swiper-wrapper">
                    
                <?php
                    foreach ($produtoCategoria1 as $produto) {
                        echo'
                            <div class="swiper-slide card_produto">
                                <div class="icon_favorite">
                                    <label class="checkbox-heart">
                                        <input type="checkbox">
                                        <i class="fa-solid fa-heart"></i>
                                    </label> 
                                </div>
                                <!-- <a style="text-decoration:none;" class="link_produto_home" href="./comprar_produto.php"> -->
                                    <div class="img_content_produto">
                                        <img src=" '.$produto['imagem'].' " alt="">
                                    </div>
                                    <div class="conteudo_card">
                                        <div class="nome_card_produto">'. $produto['nome'] .'</div>
                                        <div class="content_star_icon">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="preco_card_produto">R$ '. $produto['preco'] .'</div>
                                        <div class="btn_content_card_produto">
                                            <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i><a href="./comprar_produto.php?id_produto='.$produto['id_produto'].'"class="btn_buy_card">Comprar</a>
                                        </div>
                                    </div>
                                <!-- </a> -->
                            </div>
                            ';
                        }

                    ?>
            </div>
        </section>
        <!-- FIM 2* CARDS PRODUTOS -->





        <!-- INICIO BANNERS PROMOCIONAIS -->
        <section class="section banner_card grid grid-banner-areas">
            <div class="banner_card_1"><img src="<?= $bannerPromocionalPosicao1->caminho; ?>" alt=""></div>
            <div class="banner_card_2"><img src="<?= $bannerPromocionalPosicao2->caminho; ?>" alt=""></div>
            <div class="banner_card_3"><img src="<?= $bannerPromocionalPosicao3->caminho; ?>" alt=""></div>
            
        </section>
        <!-- FIM BANNERS PROMOCIONAIS -->




        <!-- INICIO 3* CARDS PRODUTOS -->
        <section class="card_produtos">
            <div class="swiper">
                <div class="Title_card_produto"><?php print_r($categoriaArray[1]) ?> </div>
                <div class="btn_card_produto">
                    <div class="btn_prev_card"><i class="fa-solid default_btn_icon_card fa-chevron-left"></i></div>
                    <div class="btn_next_card"><i class="fa-solid default_btn_icon_card fa-chevron-right"></i></div>
                </div>
                <div class="swiper-wrapper">
                <?php
                    foreach ($produtoCategoria2 as $produto) {
                        echo'
                            <div class="swiper-slide card_produto">
                                <div class="icon_favorite">
                                    <label class="checkbox-heart">
                                        <input type="checkbox">
                                        <i class="fa-solid fa-heart"></i>
                                    </label> 
                                </div>
                                <!-- <a style="text-decoration:none;" class="link_produto_home" href="./comprar_produto.php"> -->
                                    <div class="img_content_produto">
                                        <img src=" '.$produto['imagem'].' " alt="">
                                    </div>
                                    <div class="conteudo_card">
                                        <div class="nome_card_produto">'. $produto['nome'] .'</div>
                                        <div class="content_star_icon">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="preco_card_produto">R$ '. $produto['preco'] .'</div>
                                        <div class="btn_content_card_produto">
                                            <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i></div>
                                            <div class="btn_buy_card">Comprar</div>
                                        </div>
                                    </div>
                                <!-- </a> -->
                            </div>
                            ';
                        }

                    ?>
                
              
                </div>
            </div>
        </section>
        <!-- FIM 3* CARDS PRODUTOS -->


        <!-- INICIO CARDS CATEGORIA 2-->
        <section class="card_cat_2">    
            <div class="content_card_cat_2">
                <?php

                foreach ($categorias as $categoria) {
                    echo'
                    <a href="./categorias.php" class="item_card_cat_2" style="text-decoration: none; color: inherit;">
                        <img src=" '.$categoria->imagem.' " alt="" class="img_card_cat_2">
                        <div class="overlay_cat_2"></div>
                        <span class="text_card_cat_2">'.$categoria->nome.'</span>
                    </a>
                    ';
                }

                ?>
            </div>
        </section>
        <!-- FIM CARDS CATEGORIA 2-->




        <!-- INICIO 4* CARDS PRODUTOS -->
        <section class="card_produtos">
            <div class="swiper">
                <div class="Title_card_produto" id="chama"><?php print_r($categoriaArray[2]) ?></div>
                <div class="btn_card_produto">
                    <div class="btn_prev_card"><i class="fa-solid default_btn_icon_card fa-chevron-left"></i></div>
                    <div class="btn_next_card"><i class="fa-solid default_btn_icon_card fa-chevron-right"></i></div>
                </div>
                <div class="swiper-wrapper">
                <?php
                    foreach ($produtoCategoria3 as $produto) {
                        echo'
                            <div class="swiper-slide card_produto">
                                <div class="icon_favorite">
                                    <label class="checkbox-heart">
                                        <input type="checkbox">
                                        <i class="fa-solid fa-heart"></i>
                                    </label> 
                                </div>
                                <!-- <a style="text-decoration:none;" class="link_produto_home" href="./comprar_produto.php"> -->
                                    <div class="img_content_produto">
                                        <img src=" '.$produto['imagem'].' " alt="">
                                    </div>
                                    <div class="conteudo_card">
                                        <div class="nome_card_produto">'. $produto['nome'] .'</div>
                                        <div class="content_star_icon">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="preco_card_produto">R$ '. $produto['preco'] .'</div>
                                        <div class="btn_content_card_produto">
                                            <div class="btn_bag_card"><i class="fa-solid fa-bag-shopping"></i></div>
                                            <div class="btn_buy_card">Comprar</div>
                                        </div>
                                    </div>
                                <!-- </a> -->
                            </div>
                            ';
                        }

                    ?>
                
                
                
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="../../src/JS/swipper_card.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <script src="../../src/JS/favoritos.js"></script>
        
        <!-- FIM 4* CARDS PRODUTOS -->
        



        <!-- INICIO  BANNER FINAL  -->
        <section class="banner_promocional_final">
            <div class="content_banner_promocional_final">
                <div class="item_promocional_final">
                    <div class="text_content_promo_final">
                        <h5 class="text_call_banner_final">Dê vida ao seu ambiente com elegância!</h5>
                        <h6 class="text_call_banner_final2">Adquirir o seu</h6>
                        <div class="content_btn_banner_final"><a href="" class="btn__banner_final">Comprar</a></div>
                    </div>
                </div>
                <div class="content_img_final">
                    <img src="../../src/imagens/img_banner_final/freepik-export-20241128142345vXdB.png" alt="">
                </div>
            </div>
        </section>
        <!-- FIM BANNER FINAL  -->



    </main >


<?php

include "footer.php";



?>