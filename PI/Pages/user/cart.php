<?php
// PI/Pages/user/cart.php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../App/Core/Config.php';
require_once __DIR__ . '/../../App/DB/Database.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


use App\Controllers\CartController;
use App\Core\Config;

try {
    // Initialize configuration
    Config::initialize();
    
    // Database connection
    $db = new \App\DB\Database();
    $pdo = $db->pdo;
    
    // Initialize cart controller
    $cartController = new CartController($pdo);

    // Get and validate input
    $action = $_POST['action'] ?? '';
    $productId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $qty = filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT, [
        'options' => [
            'default' => 1,
            'min_range' => 1
        ]
    ]);

    // Validate product ID
    if (!$productId || $productId <= 0) {
        throw new InvalidArgumentException('ID de produto inválido');
    }

    $cartController->addToCart($productId, $qty);

} catch (Exception $e) {
    // Error response
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'cartCount' => array_sum(array_column($_SESSION['cart'] ?? [], 'quantidade'))
    ]);
    exit;
}