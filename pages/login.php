<?php
session_start();
include '../includes/database.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        // Consulta apenas pelo username
        $stmt = mysqli_prepare($connection, "SELECT * FROM utilizadores WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) === 1) {
            $utilizador = mysqli_fetch_assoc($resultado);

            // Verifica a password digitada com a password encriptada na BD
            if (password_verify($password, $utilizador['password'])) {
                $_SESSION['admin'] = true;
                header("Location: admin.php");
                exit();
            } else {
                $mensagem = "Password incorreta.";
            }
        } else {
            $mensagem = "Utilizador não encontrado.";
        }
    } else {
        $mensagem = "Preencha todos os campos.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <form method="POST" class="bg-white p-4 shadow rounded" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Login - Administrador</h3>

        <?php if (!empty($mensagem)): ?>
            <div class="alert alert-danger"><?= $mensagem ?></div>
        <?php endif; ?>


        <div class="mb-3">
            <label class="form-label">Utilizador</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Palavra-passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Entrar</button>
    </form>
</body>

</html>