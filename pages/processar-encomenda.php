<?php
session_start();
include '../includes/database.php';

$encomendaSucesso = false;
$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $morada = $_POST['morada'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $email = $_POST['email'] ?? '';
    $carrinho = $_SESSION['carrinho'] ?? [];
    $total = 0;

    if ($nome && $morada && $data_nascimento && $email && !empty($carrinho)) {
        // Verificar stock
        foreach ($carrinho as $id => $quantidade) {
            $res = mysqli_query($connection, "SELECT nome, preco, quantidade FROM produtos WHERE id = $id");
            $produto = mysqli_fetch_assoc($res);

            if (!$produto || $produto['quantidade'] < $quantidade) {
                $mensagemErro = "Não temos stock suficiente para o produto {$produto['nome']}.";
                break;
            }


            $total += $produto['preco'] * $quantidade;
        }

        // Inserir encomenda se não houver erro de stock
        if (!$mensagemErro) {
            mysqli_query($connection, "INSERT INTO encomendas (nome, data_nascimento, morada, email, total_encomenda) VALUES ('$nome', '$data_nascimento', '$morada', '$email', '$total')");

            // Atualizar stock
            foreach ($carrinho as $id => $quantidade) {
                mysqli_query($connection, "UPDATE produtos SET quantidade = quantidade - $quantidade WHERE id = $id");
            }

            unset($_SESSION['carrinho']);
            $encomendaSucesso = true;
        }
    } else {
        $mensagemErro = "Preencha todos os campos e adicione produtos ao carrinho.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Encomenda Confirmada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="text-center p-5 bg-white shadow rounded">
        <?php if ($encomendaSucesso): ?>
            <h2 class="mb-3 text-success">Encomenda feita com sucesso!</h2>
            <p>Muito obrigado pela sua compra. Receberá um email com os detalhes em breve.</p>
        <?php else: ?>
            <h2 class="mb-3 text-danger">Erro na encomenda</h2>
            <p><?= htmlspecialchars($mensagemErro) ?></p>
        <?php endif; ?>
        <a href="../index.php" class="btn btn-success mt-3">Voltar à Loja</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>