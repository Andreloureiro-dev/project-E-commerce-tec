// Selecionar todos os botões "Adicionar ao Carrinho"
const botoesAdicionar = document.querySelectorAll(".adicionar-ao-carrinho");

botoesAdicionar.forEach(function(botao) {
  botao.addEventListener("click", function() {
    const idProduto = botao.getAttribute("data-id");

    fetch("includes/adicionar-carrinho.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ id: idProduto })
    })
    .then(function(resposta) {
      return resposta.json();
    })
    .then(function(resultado) {
      if (resultado.sucesso) {
        atualizarCarrinho();
      } else {
        alert("Erro ao adicionar produto: " + resultado.erro);
      }
    });
  });
});

// Função para atualizar o resumo do carrinho
function atualizarCarrinho() {
  fetch("includes/obter-carrinho.php")
    .then(function(resposta) {
      return resposta.json();
    })
    .then(function(listaProdutos) {
      const lista = document.getElementById("lista-carrinho");
      const total = document.getElementById("total");

      lista.innerHTML = "";
      let somaTotal = 0;

      listaProdutos.forEach(function(produto) {
        const subtotal = produto.preco * produto.quantidade;
        somaTotal += subtotal;

        lista.innerHTML += `
          <li>
            ${produto.nome} (x${produto.quantidade}) - €${subtotal.toFixed(2).replace(".", ",")}
            <button class="btn btn-sm btn-danger ms-2 remover-item" data-id="${produto.id}">Remover</button>
          </li>
        `;
      });

      total.textContent = somaTotal.toFixed(2).replace(".", ",");

      // Botões para remover produto
      const botoesRemover = document.querySelectorAll(".remover-item");

      botoesRemover.forEach(function(botao) {
        botao.addEventListener("click", function() {
          const id = botao.getAttribute("data-id");

          fetch("includes/remover-carrinho.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({ id: id })
          })
          .then(function(resposta) {
            return resposta.json();
          })
          .then(function(resultado) {
            if (resultado.sucesso) {
              atualizarCarrinho();
            } else {
              alert("Erro ao remover produto.");
            }
          });
        });
      });
    });
}






