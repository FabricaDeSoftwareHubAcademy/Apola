<?php
require_once '../Entity/ProdutoPerso.class.php';

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate'); 
header("Content-Type: application/json; charset=UTF-8");
header("HTTP/1.1 200 OK");

$mensagem = $_POST['mensagem'] ?? '';

if (isset($_FILES['imagens']) && count($_FILES['imagens']['name']) > 0) {
    $extensoesPermitidas = ['png', 'jpg', 'jpeg', 'jfif'];
    $pastaDestino = '../../src/imagens/imagens_prod_perso/';

    $imagensCaminhos = []; // Array para guardar os caminhos

    for ($i = 0; $i < count($_FILES['imagens']['name']); $i++) {
        $nomeOriginal = $_FILES['imagens']['name'][$i];
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        if (!in_array($extensao, $extensoesPermitidas)) {
            echo json_encode([
                'success' => false,
                'message' => "A extensão do arquivo {$nomeOriginal} não é permitida."
            ]);
            exit;
        }

        $erro = $_FILES['imagens']['error'][$i];
        if ($erro !== UPLOAD_ERR_OK) {
            echo json_encode([
                'success' => false,
                'message' => "Erro no upload da imagem {$nomeOriginal}."
            ]);
            exit;
        }

        $tmpName = $_FILES['imagens']['tmp_name'][$i];
        $novoNome = uniqid('ImagemProdutoPerso_', true) . '.' . $extensao;
        $caminhoFinal = $pastaDestino . $novoNome;

        if (!move_uploaded_file($tmpName, $caminhoFinal)) {
            echo json_encode([
                'success' => false,
                'message' => "Falha ao mover a imagem {$nomeOriginal} para o destino."
            ]);
            exit;
        }

        $imagensCaminhos[] = $caminhoFinal;
    }


    $entity = new ProdutoPerso();
    $entity->tipo = "Personalizado";
    $entity->descricao = $mensagem;
    $entity->imagens = $imagensCaminhos;
    $res = $entity->cadastrarProdutoPerso();

    if ($res) {
        echo json_encode(['success' => true, 'message' => 'Produto cadastrado com sucesso!']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Falha ao cadastrar o produto.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nenhuma imagem enviada.']);
    exit;
}