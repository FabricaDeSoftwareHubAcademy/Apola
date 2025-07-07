<?php
require_once '../DB/Database.php';

$db = new Database('pedido');

// Inicializa os contadores
$counts = [
    'total'     => 0,
    'pagar'     => 0,
    'producao'  => 0,
    'envio'     => 0,
    'entregue'  => 0
];

// Total geral de pedidos
$counts['total'] = $db->select("1")->rowCount();

// Consulta agrupada por status
$sql = "SELECT status_pedido, COUNT(*) AS total FROM pedido GROUP BY status_pedido";
$dados = $db->execute($sql)->fetchAll(PDO::FETCH_ASSOC);

// Mapeia os valores ENUM para os nomes que o HTML espera
$mapStatus = [
    'A pagar'   => 'pagar',
    'Produção'  => 'producao',
    'Envio'     => 'envio',
    'Entregue'  => 'entregue'
];

// Converte os resultados da consulta para o array `$counts`
foreach ($dados as $linha) {
    $statusBanco = $linha['status_pedido'];
    $quantidade = $linha['total'];

    if (isset($mapStatus[$statusBanco])) {
        $counts[$mapStatus[$statusBanco]] = (int) $quantidade;
    }
}

// Retorna JSON
header('Content-Type: application/json');
echo json_encode($counts);
