<?php
session_start();
include 'database.php';

header('Content-Type: application/json');

// Obtém o carrinho da sessão (ou array vazio se não existir)
$carrinho = $_SESSION['carrinho'] ?? [];
$result = [];

// Para cada item no carrinho, busca nome e preço do produto na base de dados
foreach ($carrinho as $id => $quantidade) {
    $row = mysqli_fetch_assoc(mysqli_query($connection, "SELECT nome, preco FROM produtos WHERE id=" . intval($id)));
    if ($row) {
        $result[] = [
            'id' => $id,
            'nome' => $row['nome'],
            'preco' => (float)$row['preco'],
            'quantidade' => $quantidade
        ];
    }
}

// Retorna o carrinho em formato JSON
echo json_encode($result);
