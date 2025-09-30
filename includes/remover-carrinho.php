<?php
session_start();

header('Content-Type: application/json');

// Lê o ID do produto a remover do corpo da requisição
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'] ?? null;

// Remove o produto do carrinho
if ($id && isset($_SESSION['carrinho'][$id])) {
    unset($_SESSION['carrinho'][$id]);
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false]);
}
