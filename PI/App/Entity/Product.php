<?php
namespace App\Entity;

class Product
{
    private int $id_produto;
    private string $nome;
    private float $preco;
    private ?float $preco_original = null;
    private ?float $avaliacao;
    private int $quantidade;
    private string $cor;
    public ?float $altura = null;
    public ?float $largura = null;
    private string $imagem;
    private string $descricao;
    private int $categoria_id_categoria;
    private string $status_produto;
    private string $tipo;
    private ?Category $categoria = null; // objeto da classe Category

    public function __construct(array $data)
    {
        $this->id_produto = $data['id_produto'];
        $this->nome = $data['nome'];
        $this->preco = $data['preco'];
        $this->preco_original = $data['preco_original'] ?? null;
        $this->avaliacao = isset($data['avaliacao']) && $data['avaliacao'] !== '' 
            ? (float) $data['avaliacao'] 
            : null;        $this->quantidade = $data['quantidade'];
                $this->cor = $data['cor'];
        $this->altura = $data['altura'] ?? null;
        $this->largura = $data['largura'] ?? null;
        $this->imagem = $data['imagem'];
        $this->descricao = $data['descricao'];
        $this->categoria_id_categoria = $data['categoria_id_categoria'];
        $this->status_produto = $data['status_produto'];
        $this->tipo = $data['tipo'];
    }

    public function setCategory(Category $categoria): void {
        $this->categoria = $categoria;
    }

    public function getId(): int { return $this->id_produto; }
    public function getName(): string { return $this->nome; }
    public function getPrice(): float { return $this->preco; }
    public function getOriginalPrice(): ?float { return $this->preco_original; }
    public function getRating(): ?float { return $this->avaliacao; }
    public function getQuantity(): int { return $this->quantidade; }

    // Added a null coalescing fallback (?? '') so explode() always gets a string
    public function getColors(): array {
        return array_filter(array_map('trim', explode(',', $this->cor ?? '')));
    }

    public function getSizes(): array {
        return array_filter(array_map('trim', explode(',', $this->altura ?? '')));
    }

    public function getLargura(): ?float {
        return $this->largura ?? null;
    }

    public function getImageUrls(): array {
        return array_filter(array_map('trim', explode(',', $this->imagem ?? '')));
    }

    public function getDescription(): string {
        return $this->descricao;
    }

    public function getCategory(): ?Category {
        return $this->categoria ?? null;
    }

    public function getCategoryId(): int {
        return $this->categoria_id_categoria;
    }

    public function getStatus(): string {
        return $this->status_produto;
    }

    public function getType(): string {
        return $this->tipo;
    }
}


