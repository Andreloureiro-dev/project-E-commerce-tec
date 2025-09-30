<?php
session_start();
include '../includes/database.php';

// Calcula o total do carrinho somando o preço de cada produto
$total = 0;
$carrinho = $_SESSION['carrinho'] ?? [];

foreach ($carrinho as $id => $quantidade) {
    $stmt = mysqli_prepare($connection, "SELECT preco FROM produtos WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $produto = mysqli_fetch_assoc($resultado);

    if ($produto) {
        $subtotal = $produto['preco'] * $quantidade;
        $total += $subtotal;
    }
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <form action="./processar-encomenda.php" method="POST" class="bg-light p-4 rounded shadow" style="width: 100%; max-width: 500px;" onsubmit="return validarFormulario();">
            <h3 class="text-center mb-4">Finalizar Encomenda</h3>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo*</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="morada" class="form-label">Morada*</label>
                <input type="text" class="form-control" id="morada" name="morada" required>
            </div>

            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento*</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <h5>Resumo da Encomenda</h5>
                <p><strong>Total:</strong> €<?= number_format($total, 2, ',', '.') ?></p>
            </div>

            <button type="submit" class="btn btn-success w-100">Confirmar Encomenda</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../src/js/verificar-formulario.js"></script>
</body>

</html>