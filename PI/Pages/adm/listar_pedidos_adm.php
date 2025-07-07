<?php
include "nav_bar_adm.php";
require_once '../../App/config.inc.php';
require_once '../../App/Session/Login.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table {
  width: 100%;
  border-collapse: collapse;
  font-family: sans-serif;
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.container_item_list_ações{
  background-color: transparent;
  border: none;
  cursor: pointer;
  font-size: 15px;
  transition: transform 0.2s;
}

</style>
<body onload='load_table()'>
        
        <main class="main_adm">
            <div class="conatiner_dashbord_adm">
                <div class="Title_deafult_adm">
                    <div class="container_title_adm_left">
                        <span class="title_adm">Pedidos</span>
                    </div>
                    <div class="container_title_adm_right">
                        <!-- <input type="text" placeholder="Pesquisar...">
                        <i class="fa-solid fa-magnifying-glass"></i> -->

                    </div>
                    
                </div>
                <div class="conatiner_cont_dados_adm">
                    <div class="card_item_dados">
                        <i class="fa-solid fa-dolly"></i>
                        <div class="item_dados_adm">
                            <p class="n_item_dados" data-status-pedido="total"></p>
                            <p class="text_item_dados">Total de Pedidos</p>
                        </div>
                    </div>
                    <div class="shape_dados"></div>
                    <div class="card_item_dados">
                        <i class="fa-solid fa-money-bill"></i>
                        <div class="item_dados_adm">
                            <p class="n_item_dados" data-status-pedido="pagar"></p>
                            <p class="text_item_dados">Total a pagar</p>
                        </div>
                    </div>
                    <div class="shape_dados"></div>
                    <div class="shape_dados_mobile"></div>
                    <div class="card_item_dados">
                        <i class="fa-solid fa-box"></i>
                        <div class="item_dados_adm">
                            <p class="n_item_dados" data-status-pedido="producao"></p>
                            <p class="text_item_dados">Total em Produção</p>
                        </div>
                    </div>
                    <div class="shape_dados"></div>
                    <div class="card_item_dados">
                        <i class="fa-solid fa-truck-fast"></i>
                        <div class="item_dados_adm">
                            <p class="n_item_dados" data-status-pedido="envio"></p>
                            <p class="text_item_dados">Total em Envio</p>
                        </div>
                    </div>
                    <div class="shape_dados"></div>
                    <div class="card_item_dados">
                        <i class="fa-solid fa-gift"></i>
                        <div class="item_dados_adm">
                            <p class="n_item_dados" data-status-pedido="entregue"></p>
                            <p class="text_item_dados">Total Entregue</p>
                        </div>
                    </div>

                </div>
                <div class="conatiner_listar_adm">
                    <div class="container_listar_header_adm">
                        <div class="container_listar_header_adm_left" class="filtros-status">
                            <button class="btn_item_listar_adm" onclick="filtrarPedidos('A pagar')">A pagar</button>
                            <button class="btn_item_listar_adm" onclick="filtrarPedidos('Produção')">Produção</button>
                            <button class="btn_item_listar_adm" onclick="filtrarPedidos('Envio')">Envio</button>
                            <button class="btn_item_listar_adm" onclick="filtrarPedidos('Entregue')">Entregue</button>
                        </div>
                        <div class="container_listar_header_adm_right">
                            <input id="input_search" placeholder="Pesquisar Nº do pedido" type="search" name="" id="">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div class="container_listar_body_adm" style = "overflow: auto;">
                        <table class="table_adm_list" id='tabela'>
                            <thead>
                                <th>numero</th>
                                <th>total</th>
                                <th>tipo</th>
                                <th id="Mob_table_none_th" >estado</th>
                                <th>ações</th>
                            </thead>
                            <tbody id="dados">   
                            </tbody>
                        </table>
                    </div>


                </div>
                
            
            </div>
        

        </main>


        <script src="../../src/JS/btn_listar_adm.js" defer></script>
</body>
</html>
