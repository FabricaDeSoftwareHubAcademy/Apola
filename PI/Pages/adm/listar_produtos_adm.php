<?php
session_start();
include "nav_bar_adm.php";
require_once '../../App/config.inc.php';
require_once '../../App/Session/Login.php';

$result = Login::IsLogedAdm();
if($result){
    $id_administrador = $_SESSION['administrador']['id_administrador'];
}
else{
    header('location: ../user/login.php');
}
?>

<body>  
    <main class="main_adm">
        <div class="conatiner_dashbord_adm">
            <div class="Title_deafult_adm">
                <div class="container_title_adm_left">
                    <span class="title_adm">Produtos</span>
                </div>
                <div class="container_title_adm_right">
                    <a style="text-decoration:none;" href="cadastrar_produto_adm.php"><button class="btn_add_item_adm">+ Produto</button></a>
                </div>
                
            </div>
            <div class="conatiner_cont_dados_adm">
                <div class="card_item_dados">
                    <i class="fa-solid fa-dolly"></i>
                    <div class="item_dados_adm">
                        <p class="n_item_dados n_item_dados_produto" data-status="todos"></p>
                        <p class="text_item_dados">Total de Produtos</p>
                    </div>
                </div>
                <div class="shape_dados"></div>
                <div class="card_item_dados">
                    <i class="fa-solid fa-check"></i>
                    <div class="item_dados_adm">
                        <p class="n_item_dados n_item_dados_produto" data-status="ativos"></p>
                        <p class="text_item_dados">Total Ativos</p>
                    </div>
                </div>
                <div class="shape_dados"></div>
                <div class="card_item_dados">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <div class="item_dados_adm">
                        <p class="n_item_dados n_item_dados_produto" data-status="inativos"></p>
                        <p class="text_item_dados">Total Inativos</p>
                    </div>
                </div>

            </div>
            <div class="conatiner_listar_adm">
                <div class="container_listar_header_adm">
                    <div class="container_listar_header_adm_left">
                        <button id="btn_todos" class="btn_item_listar_adm btn_item_listar_produtos" data-status="todos">Todos</button>
                        <button id="btn_ativos" class="btn_item_listar_adm btn_item_listar_produtos" data-status="ativos">Ativo</button>
                        <button id="btn_inativos" class="btn_item_listar_adm btn_item_listar_produtos" data-status="inativos">Inativo</button>

                    </div>
                    <div class="container_listar_header_adm_right">
                        <input id="input_search" placeholder="Pesquisar produto" type="search" name="" id="">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    

                </div>
                <div class="container_listar_body_adm" style = "overflow: auto;">
                    <table class="table_adm_list">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                    <tbody id="dados_produtos">
                        <!-- Dados dinâmicos serão inseridos aqui via JavaScript -->
                    </tbody>
                </table>
                </div>


            </div>
            
        
        </div>
    

    </main>


    <script src="adm_nav.js"></script>
    <script src="btn_listar_adm.js"></script>
</body>
</html>