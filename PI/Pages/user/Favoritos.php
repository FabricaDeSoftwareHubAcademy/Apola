<?php


require '../../App/config.inc.php';

require '../../App/Session/Login.php';

include "head.php";


$result = Login::IsLogedCliente();

// print_r($result);
if($result){
    include "navbar_logado.php";
}else{
    header('location: login.php');
}


$id_cliente =  $_SESSION['cliente']['id_cliente'];

$favoritos = Favoritos::getFavoritosByIdUser($id_cliente);




?>
    <main  class="main2">
        <section class="container_favortos">
            <div class="left-container_favoritos">
                <div class="container_favoritos_left">
                    <div class="title_left_favoritos">Meu Perfil</div>
                    <ul>
                    <li class="item_favorito_left">
                            <i class="fa-solid icon_favorito_content  fa-house"></i><a class="link_favorito_left" href="./perfil.php">Conta</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid icon_favorito_content fa-heart"></i><a  class="link_favorito_left" href="./Favoritos.php">Favoritos</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid  icon_favorito_content fa-boxes-stacked"></i><a class="link_favorito_left" href="./historico_pedido.php">Histórico de Pedidos</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid fa-pencil icon_favorito_content"></i><a class="link_favorito_left" href="./alterar_perfil.php">Alterar Perfil</a>
                        </li>
                        <li class="item_favorito_left">
                            <i class="fa-solid fa-right-from-bracket"></i><a class="link_favorito_left" href="logout.php">Sair</a>
                        </li>
                    </ul>


                </div>
            </div>
            <div class="right_container_favoritos">
                <div class="container_favoritos_right">
                    <div class="banner_container_favoritos">
                        <img src="../../src/imagens/banner/1.png" alt="">
                    </div>
                    <div class="item_conteudo_favoritos">
                        
                    <?php

                        foreach ($favoritos as $produto) {
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
                                            <div class="btn_buy_card">Comprar</div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }


                        ?>

                    </div>

                </div>

            </div>
        </section>



    </main>
<?php

include "footer.php";



?>