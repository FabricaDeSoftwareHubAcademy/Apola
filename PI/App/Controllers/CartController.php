<?php

// controllers/CartController.php
namespace App\Controllers;
use PDO;

// session_start();  Make sure session is started before reading/writing $_SESSION

require_once __DIR__ . '/../Entity/ProductModel.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

class CartController
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var ProductModel
     */
    private $productModel;

    /**
     * Constructor.
     *
     * @param \PDO $pdo  A PDO instance connected to your MySQL database.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->productModel = new \App\Entity\ProductModel($pdo);

        // Ensure $_SESSION['cart'] is always an array
        // if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        //     $_SESSION['cart'] = [];
        // }
    }

    /**
     * Display the cart page.
     *
     * - Reads the cart from $_SESSION['cart'] (an array of ['id_produto' => int, 'quantidade' => int]).
     * - Uses ProductModel to fetch full product details.
     * - Merges DB data with quantidade.
     * - Includes a PHP view (e.g. 'views/cart_view.php') which loops over $cartItemsDetailed.
     */
    public function showCart(): array
{
    $cartSession = $_SESSION['cart'] ?? [];
    
    if (empty($cartSession)) {
        return [
            'cartItems' => [],
            'subtotal' => 0,
            'shipping' => 22.69,
            'total' => 22.69
        ];
    }

    $cartItems = [];
    $subtotal = 0;
    
    foreach ($cartSession as $productId => $item) {
        // Skip invalid items
        if (!isset($item['quantidade']) || $item['quantidade'] <= 0) {
            continue;
        }

        $qty = (int)$item['quantidade'];
        $unitPrice = (float)($item['preco'] ?? 0);
        $lineTotal = $unitPrice * $qty;
        $subtotal += $lineTotal;

        // Handle image - use first image if array
        $image = is_array($item['imagem']) ? ($item['imagem'][0] ?? '') : ($item['imagem'] ?? '');
        
        // Handle color - join array or use string
        $color = is_array($item['cor']) ? implode(', ', $item['cor']) : ($item['cor'] ?? '');
        
        // Handle size/height
        $size = '';
        if (!empty($item['altura']) && is_array($item['altura'])) {
            $size = implode(', ', array_filter($item['altura']));
        } elseif (!empty($item['altura'])) {
            $size = $item['altura'];
        }

        $cartItems[] = [
            'id_produto' => (int)$productId,
            'nome' => $item['nome'] ?? 'Produto sem nome',
            'imagem' => $image,
            'cor' => $color,
            'tamanho' => $size,
            'preco' => $unitPrice,
            'quantidade' => $qty,
            'line_total' => $lineTotal
        ];
    }

    // Calculate totals
    $shipping = 22.69;
    $total = $subtotal + $shipping;

    return [
        'cartItems' => $cartItems,
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total
    ];
}

    /**
     * Add one unit of $productId to the cart (or increment if it already exists).
     * Redirects back to cart page or returns JSON, depending on your preference.
     *
     * @param int $productId
     */
    // AddToCart method fix
    // App/Controllers/CartController.php
// App/Controllers/CartController.php
public function addToCart(int $productId, int $qty = 1): void
{
    if ($qty <= 0) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => 'Quantidade inválida',
            'cartCount' => array_sum(array_column($_SESSION['cart'] ?? [], 'quantidade'))
        ]);
        exit;
    }
    
    $product = $this->productModel->getProductById($productId);
    if ($product === null) {
        http_response_code(404);
        echo json_encode([
            'status' => 'error', 
            'message' => 'Produto não encontrado',
            'cartCount' => array_sum(array_column($_SESSION['cart'] ?? [], 'quantidade'))
        ]);
        exit;
    }

    // Initialize cart if needed
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add or update item in cart
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantidade'] += $qty;
    } else {
        $_SESSION['cart'][$productId] = [
            'id' => $productId,
            'nome' => $product->getName(),
            'preco' => $product->getPrice(),
            'imagem' => $product->getImageUrls()[0] ?? '',
            'cor' => implode(', ', $product->getColors()),
            'altura' => implode(', ', $product->getSizes()),
            'quantidade' => $qty
        ];
    }

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success', 
        'cartCount' => array_sum(array_column($_SESSION['cart'], 'quantidade'))
    ]);
    exit;
}

    /**
     * Update the quantidade for a given $productId to a new $quantidade.
     * If $quantidade <= 0, remove the item entirely.
     *
     * @param int $productId
     * @param int $quantidade
     */
   public function updateQuantity(int $productId, int $qty): void
    {
        if (!isset($_SESSION['cart'][$productId])) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado']);
            exit;
        }

        if ($qty <= 0) {
            $this->removeFromCart($productId);
            return;
        }

        $_SESSION['cart'][$productId]['quantidade'] = $qty;
        session_write_close();

        $cartData = $this->showCart();

        echo json_encode([
            'status' => 'success',
            'cartItems' => $cartData['cartItems'],
            'subtotal' => $cartData['subtotal'],
            'shipping' => $cartData['shipping'],
            'total' => $cartData['total'],
            'cartCount' => array_sum(array_column($_SESSION['cart'], 'quantidade'))
        ]);
        exit;
    }

    public function removeFromCart(int $productId): void
    {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
            session_write_close();
        }

        $cartData = $this->showCart();

        echo json_encode([
            'status' => 'success',
            'cartItems' => $cartData['cartItems'],
            'subtotal' => $cartData['subtotal'],
            'shipping' => $cartData['shipping'],
            'total' => $cartData['total'],
            'cartCount' => array_sum(array_column($_SESSION['cart'] ?? [], 'quantidade'))
        ]);
        exit;
    }
}
