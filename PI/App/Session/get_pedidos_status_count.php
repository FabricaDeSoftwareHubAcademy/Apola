<?php
require_once '../DB/Database.php';

$db = new Database('pedido');

$result = $db->select();
$pedidos = $result->fetchAll(PDO::FETCH_ASSOC);


$counts = [
    'total' => 0,
    'A pagar' => 0,
    'Produção' => 0,
    'Envio' => 0,
    'Entregue' => 0
];

// conta cada pedido
foreach ($pedidos as $pedido) {
    $counts['total']++;
    $status = $pedido['status_pedido'];
    if (isset($counts[$status])) {
        $counts[$status]++;
    }
}

echo json_encode($counts);
