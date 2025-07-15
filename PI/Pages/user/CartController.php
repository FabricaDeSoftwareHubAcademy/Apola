<?php

// File: carrinho.php (ou qualquer rota que exiba o carrinho)
require_once __DIR__ . '/vendor/autoload.php'; // ou ajustes do seu autoloader
require_once __DIR__ . '/src/controllers/CartController.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ### Crie sua conexão PDO (substitua host, dbname, user, pass pelos seus dados)
$dsn = 'mysql:host=localhost;dbname=minha_database;charset=utf8mb4';
$pdo = new PDO($dsn, 'db_username', 'db_password', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

// ### Instancie o CartController
$cartController = new CartController($pdo);

// ### Decida qual ação chamar, via query string ou roteamento
// Por exemplo: ?action=show, ?action=add&id=123, ?action=update&id=123&qty=2, ?action=remove&id=123
$action = $_GET['action'] ?? 'show';

switch ($action) {
    case 'add':
        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $quantity  = isset($_GET['qty']) ? (int)$_GET['qty'] : 1; // Get quantity from request
        $cartController->addToCart($productId, $quantity); // Pass quantity to method
        break;

    case 'update':
        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $quantity  = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;
        $cartController->updateQuantity($productId, $quantity);
        break;

    case 'remove':
        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $cartController->removeFromCart($productId);
        break;

    case 'show':
    default:
        $cartController->showCart();
        break;
}
