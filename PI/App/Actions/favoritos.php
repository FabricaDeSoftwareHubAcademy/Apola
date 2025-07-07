<?php

require '../../App/config.inc.php';
require '../../App/Session/Login.php';

header('Content-Type: application/json');

if (isset($_GET['IdProduct']) && isset($_GET['Statusfavorito'])) {

    if (Login::IsLogedCliente()) {

        $productId = $_GET['IdProduct'];
        $statusFavorito = $_GET['Statusfavorito'];
        $idCliente = $_SESSION['cliente']['id_cliente'];

        $favoritos = new Favoritos();

        if ($statusFavorito == 'a') {
            

            $result = $favoritos->removerFavorito($idCliente,$productId);

      

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Removido dos favoritos', 'type' => 'excluir']);
            } 

        } else if ($statusFavorito == 'i') {
         
            $favoritos->cliente_id_cliente = $idCliente;
            $favoritos->produto_id_produto = $productId;
            $favoritos->status_favoritos = 'a'; 

            $result = $favoritos->cadastrar();

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Adicionado aos favoritos']);
            } 
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não está logado']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Nenhum ID recebido']);
}
