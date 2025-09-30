const botaoFiltrar = document.getElementById("btn-filtrar");

botaoFiltrar.addEventListener("click", function () {
  const categoria = document.getElementById("categoria").value;
  const preco = document.getElementById("preco").value;
  const produtos = document.querySelectorAll(".produto-card");

  produtos.forEach(function (produto) {
    const categoriaProduto = produto.dataset.categoria;
    const precoProduto = parseFloat(produto.dataset.preco);
    let mostrar = true;

    if (categoria && categoriaProduto !== categoria) {
      mostrar = false;
    }

    if (preco && precoProduto > parseFloat(preco)) {
      mostrar = false;
    }

    produto.style.display = mostrar ? "block" : "none";
  });
});