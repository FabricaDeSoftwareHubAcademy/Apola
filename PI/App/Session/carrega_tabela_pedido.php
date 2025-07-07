<?php

require_once '../Entity/Pedido.class.php';

$status = $_GET['status'] ?? '';
$search = $_GET['search'] ?? '';

if (!empty($status)) {
    $status = addslashes($status);
    $where = "pedido.status_pedido = '$status'";
    $dados = Pedido::buscar($where);
    echo json_encode($dados ?: []);
    exit;
}

if (!empty($search)) {
    $search = addslashes(trim($search));
    if (is_numeric($search)) {
        $where = "pedido.id_pedido = $search";
    } else {
        $where = "pedido.tipo LIKE '%$search%' OR cliente.estado LIKE '%$search%'";
    }

    $dados = Pedido::buscar($where);
    echo json_encode($dados ?: []);
    exit;
}
$dados = Pedido::buscar();
// todos os pedidos
echo json_encode($dados ?: []);
