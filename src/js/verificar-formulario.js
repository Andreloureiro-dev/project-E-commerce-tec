function validarFormulario() {
    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const idade = document.getElementById("idade").value;

    if (!nome || !email || !idade) {
        alert("Por favor, preencha todos os campos.");
        return false;
    }

    // Verificar se email é válido
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Por favor, insira um email válido.");
        return false;
    }

    // Verificar se idade é maior ou igual a 18
    if (isNaN(idade) || parseInt(idade) < 18) {
        alert("Tem de ser maior de 18 anos.");
        return false;
    }

    return true;
}
