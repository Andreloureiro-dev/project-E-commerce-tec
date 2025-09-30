<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;

    // Adiciona o produto ao carrinho na sessão
    if ($id) {
        if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = [];
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]++;
        } else {
            $_SESSION['carrinho'][$id] = 1;
        }
        echo json_encode(['sucesso' => true]);
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'ID inválido']);
    }
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Método não POST']);
}

