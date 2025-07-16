<?php
namespace App\Entity;

class Category
{
    private int $id;
    private string $nome;

    public function __construct(array $data)
    {
        $this->id = $data['id_categoria'] ?? 0;
        $this->nome = $data['nome_categoria'] ?? '';
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->nome;
    }
}
