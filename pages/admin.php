<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../includes/database.php';

// Atualizar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['atualizar_produto'])) {
        $id = (int) $_POST['id'];
        $preco = (float) $_POST['preco'];
        $quantidade = (int) $_POST['quantidade'];

        mysqli_query($connection, "UPDATE produtos SET preco = $preco, quantidade = $quantidade WHERE id = $id");
    }

    // Adicionar novo produto
    if (isset($_POST['adicionar_produto'])) {
        $nome = mysqli_real_escape_string($connection, $_POST['nome']);
        $preco = (float) $_POST['preco'];
        $quantidade = (int) $_POST['quantidade'];
        $categoria = mysqli_real_escape_string($connection, $_POST['categoria']);
        $imagem = mysqli_real_escape_string($connection, $_POST['imagem']);

        mysqli_query($connection, "INSERT INTO produtos (nome, preco, quantidade, categoria, imagem) 
            VALUES ('$nome', $preco, $quantidade, '$categoria', '$imagem')");
    }
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">
    <div class="container">
        <h2 class="mb-4">Área de Administração</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="../index.php" class="btn btn-danger">Voltar à loja</a>
        </div>

        <h4>Encomendas</h4>
        <table class="table table-bordered table-striped mb-5">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Morada</th>
                    <th>Email</th>
                    <th>Data Nascimento</th>
                    <th>Total (€)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($connection, "SELECT * FROM encomendas");
                while ($encomenda = mysqli_fetch_assoc($res)) {
                    echo "<tr>
                        <td>{$encomenda['nome']}</td>
                        <td>{$encomenda['morada']}</td>
                        <td>{$encomenda['email']}</td>
                        <td>{$encomenda['data_nascimento']}</td>
                        <td>" . number_format($encomenda['total_encomenda'], 2, ',', '.') . "</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <h4>Produtos em stock</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço (€)</th>
                    <th>Quantidade</th>
                    <th>Atualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($connection, "SELECT * FROM produtos");
                while ($produto = mysqli_fetch_assoc($res)) {
                    echo "<tr>
                        <form method='POST'>
                            <td>{$produto['nome']}</td>
                            <td><input type='number' step='0.01' name='preco' value='{$produto['preco']}' class='form-control'></td>
                            <td><input type='number' name='quantidade' value='{$produto['quantidade']}' class='form-control'></td>
                            <td>
                                <input type='hidden' name='id' value='{$produto['id']}'>
                                <button type='submit' name='atualizar_produto' class='btn btn-warning btn-sm'>Atualizar</button>
                            </td>
                        </form>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <h4 class="mt-5">Adicionar Novo Produto</h4>
        <form method="POST" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="nome" class="form-control" placeholder="Nome" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="preco" step="0.01" class="form-control" placeholder="Preço" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="quantidade" class="form-control" placeholder="Quantidade" required>
            </div>
            <div class="col-md-2">
                <select name="categoria" class="form-select" required>
                    <option value="">Categoria</option>
                    <option value="computador">Computador</option>
                    <option value="portatil">Portátil</option>
                    <option value="telemovel">Telemóvel</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="imagem" class="form-control" placeholder="Link da Imagem" required>
            </div>
            <div class="col-md-12">
                <button type="submit" name="adicionar_produto" class="btn btn-success w-100">Adicionar Produto</button>
            </div>
        </form>
    </div>
</body>

</html>