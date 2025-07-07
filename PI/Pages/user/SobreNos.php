<?php

include "head.php";

require '../../App/config.inc.php';

require '../../App/Session/Login.php';


if (Login::IsLogedCliente()) {
    include 'navbar_logado.php';
} 
else {
    include 'navbar_deslogado.php';
}
    



?>
    <main style=" margin-bottom: unset;"  class="main2">

        <!-- <section class="Banner_Sobre_Nos"> -->
            <!-- <div class="shape_sobre"></div> -->
            <!-- <div class="content_banner_sobre_nos"> -->
                <!-- <img class="img_sobre_banner" src="../../src/imagens/SobreMim/freepik-export-20241209130412wAw2.jpeg" alt="">
                <div class="content_coteudo_banner_sobre">
                    <h4 class="text_top_sobre">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h4>
                    <h5 class="text_bottom_sobre">Lorem ipsum dolor, sit amet consectetur adipisicing elit. </h4>
                    <button class="btn_sobre"> <a href="">Conheça</a></button>
                </div>
            </div>
        </section> -->

        <section class="about_text">
            <div class="content_about_text">
                <div class="right_about_text">
                    <img src="../../src/imagens/login/asdfghjk.png" alt="">
                </div>
                <div class="left_about_text">
                    <div class="title_text_about"> Sobre nós <span class="title_text_about2"> Apola Artesanatos </span></div>
                    <div class="conteudo_text_about">  

                        <p class="texto_about">  
                        A Apola Ecommerce Artesanatos nasceu para conectar artesãos talentosos a um público que valoriza a autenticidade e o trabalho manual.
                        Nossa loja virtual oferece uma curadoria especial de produtos artesanais, incluindo itens decorativos, joias, roupas, acessórios e utilidades domésticas, todos feitos com dedicação e qualidade por artesãos locais e regionais.
                        Nosso propósito é ampliar a visibilidade do artesanato, promovendo a cultura e incentivando o consumo consciente.
                        Trabalhamos para garantir uma experiência de compra intuitiva, segura e satisfatória, com um catálogo detalhado, fotos de alta qualidade e um checkout simplificado. Além disso, proporcionamos um ambiente onde artesãos podem gerenciar seus estoques e pedidos com facilidade.
                        </p>

                        <p class="texto_about">
                        Acreditamos que cada peça conta uma história e queremos levá-las até você. Siga-nos nas redes sociais e faça parte dessa comunidade apaixonada por arte e criatividade. Juntos, valorizamos o feito à mão!
                        </p>
                        
        
                    
                    </div>
                    <div class="content_number_dados_sobre">

                        <div class="couteudo_dados_sobre">
                            <div class="number_dados_sobre">28+</div>
                            <div class="text_dados_sobre">Apola Ecommerce Artesanatos</div>
                        </div>

                        <div class="couteudo_dados_sobre">
                            <div class="number_dados_sobre">894+</div>
                            <div class="text_dados_sobre">Apola Ecommerce Artesanatos</div>
                        </div>

                        <div class="couteudo_dados_sobre">
                            <div class="number_dados_sobre">42+</div>
                            <div class="text_dados_sobre">Apola Ecommerce Artesanatos</div>
                        </div>

                    </div> 

                    <!-- <div class="content_btn_about">
                        <button class="btn_about">Confira</button>
                    </div> -->
                </div>

            </div>
        </section>

        <!-- <section class="cards_service">
            <div class="content_cards_service">
                <h1 class="title_section_sobre">
                    Lorem ipsum dolor sit <span class="title_section_sobre2">amet consectetur</span>
                </h1>
                <div class="item_cards_service">
                    <div class="right_item_cards_service">
                        <img src="../../src/imagens/SobreMim/1.png" alt="">
                    </div>
                    <div class="left_item_cards_service">
                        <div class="text_apola_card_service">APOLA</div>
                        <div class="text_card_service"> - Produtos Unicos </div>
                        <div class="content_btn_card_service">
                            <button class="btn_card_service">Veja <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="item_cards_service">
                    <div class="left_item_cards_service">
                        <div class="text_apola_card_service">APOLA</div>
                        <div class="text_card_service"> - Produtos Personalizados </div>
                        <div class="content_btn_card_service">
                            <button class="btn_card_service">Veja <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
                    <div class="right_item_cards_service">
                        <img src="../../src/imagens/SobreMim/2.png" alt="">
                    </div>
                </div>
            </div>
        </section> -->

        <!-- SEÇÃO DE COMENTÁRIOS DOS USUÁRIOS -->
        <section class="comentarios-container content_card_avalicao_sobre"> <!-- Define o Formato do Container -->
            <h2>O que dizem sobre nós</h2>

            <!-- Slides do Carrossel -->
            <div class="swiper_sobre">

                    <!-- Card dos Comentários -->
                <div class="swiper-wrapper" id="carregar-avaliacoes-sobre-nois">

                </div>
                    <!-- <div class="comentario swiper-slide">
                        Avatar fictício
                        <img class="avatar" src="../../src/imagens/sobre_nos/avatar_carlos.png" alt="Carlos Henrique"/>
                        <p class="nome">Carlos Henrique</p>
                        <div class="comentario-texto">
                        <p class="justificar-texto">Minha esposa adorou o presente que comprei aqui!<br>
                            Parabéns pelo capricho e cuidado em cada detalhe!</p>
                        </div>

                        <div class="content_star_sobre">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div> -->

                    <!-- <div class="comentario swiper-slide">
                        Avatar fictício
                        <img src="../../src/imagens/sobre_nos/avatar_ana.png" alt="Ana Luiza" class="avatar">
                        <p class="nome">Ana Luiza</p>
                        <div class="comentario-texto">
                        <p class="justificar-texto">Sou cliente há meses e cada nova compra me surpreende.<br>
                            Vocês realmente sabem como encantar!</p>
                        </div>
                        <div class="content_star_sobre">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div> -->
                    <!-- <div class="comentario swiper-slide">
                        Avatar fictício
                        <img src="../../src/imagens/sobre_nos/lourdes.jpg" alt="Ana Luiza" class="avatar">
                        <p class="nome">Lourdes Rodrigues</p>
                        <div class="comentario-texto">
                        <p class="justificar-texto">Sou consumidora Apola, estou feliz com as minhas aquisições. <br> E indico para quem prioriza um trabalho personalizado e de qualidade!!</p>
                        </div>
                        <div class="content_star_sobre">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div> -->
            </div>

            <!-- Setinhas do Carrossel -->
            <div class="swiper-pagination-sobre"></div>
            <div class="btn_card_sobre">
                <div class="btn_prev_card_avaliacao"><i class="fa-solid default_btn_icon_card fa-chevron-left"></i></div>
                <div class="btn_next_card_avaliacao"><i class="fa-solid default_btn_icon_card fa-chevron-right"></i></div>
            </div>
        </section>

        <!-- ################################################################################################################## -->

        <!-- Tarefa Lourdes: Fazer uma estrutura completa para o cliente deixar sua avaliação sobre a loja - Taslk 45  -->

        <!-- Formulário horizontal - Avaliação -->

        
        <!-- Container da avaliação -->
        <section class="sessao-avaliacao">
            <h2 class="avaliacao-titulo">Deixe sua Avaliação</h2>
            <div class="avaliacao-container">
                
                <form class="avaliacao-form" id="formulario_avaliacao" method="POST">
                    <div class="form-row">
                        <div class="form-group nota">
                            <label for="nota">Nota:</label>
                            <div class="estrelas-avaliacao">
                                <input type="radio" id="estrela5" name="nota" value="5"><label for="estrela5"><i class="fas fa-star"></i></label>
                                <input type="radio" id="estrela4" name="nota" value="4"><label for="estrela4"><i class="fas fa-star"></i></label>
                                <input type="radio" id="estrela3" name="nota" value="3"><label for="estrela3"><i class="fas fa-star"></i></label>
                                <input type="radio" id="estrela2" name="nota" value="2"><label for="estrela2"><i class="fas fa-star"></i></label>
                                <input type="radio" id="estrela1" name="nota" value="1"><label for="estrela1"><i class="fas fa-star"></i></label>
                            </div>
                        </div>
    
    
    
                        <!-- Campo Mensagem ao centro -->
                        <div class="form-group mensagem">
                        <label for="mensagem">Avaliação:</label>
                        <textarea maxlength="200" id="mensagem" name="mensagem" placeholder="Como foi sua experiência?" required oninput="atualizarContador()"></textarea>
                        <small><span id="contador">0</span>/200 caracteres</small>
                        </div>
                        <!-- Botão ao lado -->
                        <div class="form-group botao">
                            <button type="submit" class="botao-enviar">Enviar Avaliação</button>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-sobre-nois-avaliado">
                <div class="conteudo-modal">
                    <i class="fa-solid fa-check"></i>
                    <p>Avaliado com sucesso!</p>
                </div>
            </div>
            <div class="modal-sobre-nois-not-avaliado">
                <div class="conteudo-modal-not">
                    <p>Você deve estar logado para avaliar!</p>
                    <p>Realizar <a href="Login.php">Login</a></p>
                </div> 
            </div>
            <div class="modal-sobre-nois-sem-estrela">
                <div class="conteudo-modal-sem-estrela">
                    <p>Você deve inserir ao menos uma estrela para avaliar!</p>
                </div> 
            </div>
        </section>

    </main>

<?php
include "footer.php";
?>

        <!-- ################################################################################################################## -->




        
 






        