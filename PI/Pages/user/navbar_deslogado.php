<?php



    $categorias= Categoria::buscarCategoria();
    

?>

    <!-- INICIO MeENU NAVABAR -->
    <header class="menu">
        <nav class="container-menu">
                <div class="img-menu">
                    <a href="./Home.php">
                        <img src="../../Src/imagens/Apola__1_-removebg-preview.png" alt=""class="img-logo" >
                    </a>
                </div>
                <div class="barra-pesquisa">
                    <div class="container-barra">
                        <input class="input-pesquisa" type="text" placeholder="Pesquise seu produto...">
                        <a href="#" class="btn-pesquisa">
                                <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </div>
        <!-- INICIO MENU MOBILE -->
                <div class="btn-abrir-menu" id="btn-menu-abrir">
                    <i class="fa-solid fa-bars"></i>
                </div>

                <div class="mobile-btn" id="mobile-btn">
                    <div class="btn-fechar" id="btn-fechar">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div class="content-mobile-top">
                        <div class="img-content-mobile">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="text-content-mobile"><span>Faça seu login ou cadastra-se</span></div>
                    </div>
                    <div class="content-mobile-btn-login-cad">
                        <button class="btn-login-mobile">
                            <a href="./login.php">Login</a>

                        </button>
                        <button class="btn-cadastro-mobile">
                            <a href="./cadastro.php">Cadastro</a>
                        </button>
                    </div>
                    <div class="barra-pesquisa-mobile">
                        <div class="content-mobile-pesquisa">
                            <input type="text"><button class="btn-pesquisa-mobile"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>

                    <div class="content-conteudo-mobile">
                        <h5>Destaque</h5>
                        <ul>
                            <li>
                                <i class="fa-solid fa-fire"></i>
                                <a href="./home.php">Mais Vendidos</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-dollar-sign"></i>
                                <a href="./home.php">Ofertas</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-box"></i>
                                <a href="./produto_personalizado.php">Produto Personalizado</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-people-group"></i>
                                <a href="./SobreNos.php">Sobre Nós</a>
                            </li>
                        </ul>
                        <h5>Categorias</h5>
                        <ul>
                            <li class="categoria-content-mobile-items">
                                <a href="./cate">Amigurumi</a>
                                <i class="fa-solid fa-chevron-right"></i>
                            </li>
                            <div class="submenu-drop-mobile">
                                <ul class="dropdown__menu">
                                    <div class="btn-voltar-submenu">
                                        <i class="fa-solid fa-chevron-left"></i><p class="text-submenu-voltar">voltar</p>
                                    </div>
                                    <li><a class="drop__link" href="#">Amigurumi Cacto</a></li>
                                    <li><a class="drop__link" href="#">Amigurumi Urso</a></li>
                                </ul>
                            </div>
                        
                            <li class="categoria-content-mobile-items">
                                <a href="#">Cachepô</a>
                                <i class="fa-solid fa-chevron-right"></i>
                            </li>
                            <div class="submenu-drop-mobile">
                                <ul class="dropdown__menu">
                                    <div class="btn-voltar-submenu">
                                        <i class="fa-solid fa-chevron-left"></i><p class="text-submenu-voltar">voltar</p>
                                    </div>
                                    <li><a class="drop__link" href="#">Cachepô Bolsa</a></li>
                                    <li><a class="drop__link" href="#">Cachepô Tapete</a></li>
                                </ul>
                            </div>
                        
                            <li class="categoria-content-mobile-items">
                                <a href="#">Porta-Chaves</a>
                                <i class="fa-solid fa-chevron-right"></i>
                            </li>
                            <div class="submenu-drop-mobile">
                                <ul class="dropdown__menu">
                                    <div class="btn-voltar-submenu">
                                        <i class="fa-solid fa-chevron-left"></i><p class="text-submenu-voltar">voltar</p>
                                    </div>
                                    <li><a class="drop__link" href="#">Porta-Chaves de raposa</a></li>
                                    <li><a class="drop__link" href="#">Porta-Chaves de raposa</a></li>
                                </ul>
                            </div>
                            <li class="categoria-content-mobile-items">
                                <a href="#">Bordado</a>
                                <i class="fa-solid fa-chevron-right"></i>
                            </li>
                            <div class="submenu-drop-mobile">
                                <ul class="dropdown__menu">
                                    <div class="btn-voltar-submenu">
                                        <i class="fa-solid fa-chevron-left"></i><p class="text-submenu-voltar">voltar</p>
                                    </div>
                                    <li><a class="drop__link" href="#">Bordado paisagem</a></li>
                                    <li><a class="drop__link" href="#">Bordado paisagem</a></li>
                                </ul>
                            </div>
                        </ul>
                        
                    </div>
                </div>
                <div class="overlay-mobile" id="overlay-mobile"></div>
        <!-- FIM MENU MOBILE -->
                <div class="lista-item">
                    <nav class="itens-menu">
                        <ul class="menu-main">
                            <li class="icon-default-back">
                                <a id="icon-default" href="./SobreNos.php">Sobre Nós</a>
                            </li>
                            <li class="icon-default-back">
                                <a id="icon-default" href="./produto_personalizado.php">Personalize</a>
                            </li>
                            <li id="text-categoria">
                                <a href="#">Categorias<i class="fa-solid fa-chevron-down icon-seta"></i></a>
                                <div class="mega-menu">
                                    <div class="mega-menu-content">
                                    <?php

                                        foreach ($categorias as $categoria) {
                                            
                                            echo'
                                            <div class="row">
                                                <h3 class="Title-cat"><a href="./categorias.php">'.$categoria->nome.'</a></h3>
                                                <ul class="mega-links">
                                                    <!-- <li><a href="">Amigurumi Cacto</a></li>
                                                    <li><a href="">Amigurumi Cacto</a></li>
                                                    <li><a href="">Amigurumi Cacto</a></li>
                                                    <li><a href="">Amigurumi Cacto</a></li> -->
                                                </ul>
                                            </div>

                                            ';

                                        }

                                        ?>
                                    </div>
                                </div>
                            </li>
                            <li class="icon-default-back">
                                <a id="icon-default" href="./carrinho.php"><i class="fa-solid fa-bag-shopping"></i></a>
                            </li>
                            <li class="icon-default-back">
                                <a id="icon-default" href=""><i class="fa-solid fa-user"></i></a>
                                <ul class="drop-menu">
                                    <div class="shape-perfil"></div>
                                    <li><a href="./login.php">Login</a></li>
                                    <li><a href="./cadastro.php">Cadastro</a></li>
                                </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
        </nav>
        <!-- FIM MENU NAVBAR -->
    </header>