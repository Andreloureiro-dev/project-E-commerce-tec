<?php
session_start();
include './includes/database.php';
include './includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Final - Loja de Informatica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./src/css/style.css">
</head>

<body>

    <main>
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active"><img src="./src/img/promo 1.webp" class="d-block w-100" alt="promo 1"></div>
                <div class="carousel-item"><img src="./src/img/promo 2.jpg" class="d-block w-100" alt="promo 2"></div>
                <div class="carousel-item"><img src="./src/img/promo 3.webp" class="d-block w-100" alt="promo 3"></div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="container mt-5">
            <div class="row">
                <aside class="col-md-2 mb-4">
                    <h5>Filtrar produtos</h5>
                    <form id="filtro-form" class="p-3 bg-light rounded shadow">
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select class="form-select" id="categoria">
                                <option value="">Todas</option>
                                <option value="computador">Computador</option>
                                <option value="portatil">Portátil</option>
                                <option value="telemovel">Telemóvel</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço máximo (€)</label>
                            <input type="number" class="form-control mb-3" id="preco" min="0">
                            <button type="button" id="btn-filtrar" class="btn btn-success w-100">Filtrar</button>
                        </div>
                    </form>
                </aside>

                <section class="col-md-8 mb-4">
                    <div id="lista-produtos" class="row g-4">
                        <?php
                        $sql = "SELECT * FROM produtos";
                        $resultado = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($resultado) > 0) {
                            while ($produto = mysqli_fetch_assoc($resultado)) {
                                echo '<div class="col-md-4 produto-card" data-categoria="' . $produto['categoria'] . '" data-preco="' . $produto['preco'] . '">';
                                echo '  <div class="card h-100 shadow-lg border-0">';
                                echo '    <img src="' . $produto['imagem'] . '" class="card-img-top p-3" alt="' . htmlspecialchars($produto['nome']) . '" style="height: 200px; object-fit: contain;">';
                                echo '    <div class="card-body d-flex flex-column">';
                                echo '      <h5 class="card-title text-center">' . htmlspecialchars($produto['nome']) . '</h5>';
                                echo '      <p class="card-text text-center fw-bold text-success">€' . number_format($produto['preco'], 2, ',', '.') . '</p>';
                                echo '      <button class="btn btn-success mt-auto w-100 adicionar-ao-carrinho" data-id="' . $produto['id'] . '">Adicionar ao Carrinho</button>';
                                echo '    </div>';
                                echo '  </div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Nenhum produto encontrado.</p>';
                        }
                        ?>
                    </div>
                </section>

                <aside class="col-md-2">
                    <div class="card sticky-top">
                        <div class="card-body">
                            <h5 class="card-title">Resumo da Compra</h5>
                            <ul id="lista-carrinho" class="list-group mb-3"></ul>
                            <p>Total: <span id="total">0.00</span> €</p>
                            <a href="pages/checkout.php" class="btn btn-success w-100 mt-2">Concluir Compra</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script src="./src/js/filtro-produtos.js"></script>
    <script src="./src/js/carrinho.js"></script>

    <?php include 'includes/footer.php'; ?>
</body>

</html>