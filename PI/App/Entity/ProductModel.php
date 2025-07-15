<?php

// PI/App/Entity/ProductModel.php
namespace App\Entity;

use App\Entity\Product;
use App\Entity\Category;

require_once __DIR__ . '/../DB/Database.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

class ProductModel
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Constructor.
     *
     * @param \PDO $pdo  A PDO instance connected to your MySQL database.
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Fetch all product rows whose id_produto is in the given array of IDs.
     *
     * @param int[] $ids  Array of product IDs to retrieve.
     * @return array      Indexed array of products (each as associative array).
     */
    public function getProductsByIds(array $ids): array
    {
        // Add safety check for IDs
        $ids = array_filter($ids, 'is_numeric');
        if (empty($ids)) return [];

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "
            SELECT 
                p.id_produto,
                p.nome,
                p.preco,
                p.preco_original,
                p.avaliacao,
                p.quantidade,
                p.cor,
                p.tamanho,      
                p.imagem,
                p.descricao,
                p.categoria_id_categoria,
                p.status_produto,
                p.tipo,
                p.largura,      
                p.altura        
            FROM produto p
            WHERE p.id_produto IN ($placeholders)
        ";

        $stmt = $this->pdo->prepare($sql);
        foreach ($ids as $i => $id) {
            $stmt->bindValue($i + 1, (int)$id, \PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a single product by its ID, return a fully-hydrated Product entity.
     *
     * @param int $id
     * @return Product|null
     */
    // App/Entity/ProductModel.php
    public function getProductById(int $id): ?Product
    {
        $sql = "
            SELECT 
                p.id_produto,
                p.nome,
                p.preco,
                p.avaliacao,
                p.quantidade,
                p.cor,
                p.imagem,
                p.descricao,
                p.categoria_id_categoria,
                p.status_produto,
                p.tipo,
                p.largura,
                p.altura,
                c.id_categoria,
                c.nome AS nome_categoria
            FROM produto p
            JOIN categoria c ON p.categoria_id_categoria = c.id_categoria
            WHERE p.id_produto = :id
            LIMIT 1
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        // Hydrate Product entity with its scalar data
        $product = new Product($row);

        // Build the Category entity
        $categoryData = [
            'id_categoria'   => $row['id_categoria'],
            'nome_categoria' => $row['nome_categoria'],
        ];
        $category = new Category($categoryData);

        // Attach the Category to the Product
        $product->setCategory($category);

        return $product;
    }

}
