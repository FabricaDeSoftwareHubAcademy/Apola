let cadastradoSucesso = document.getElementById('spanCadastrado').textContent.trim();
let modalCadastro = document.getElementById('modalCadastro');
let btnFecharCadastro = document.getElementById('fecharModalCadastro');

function abrirModal() {
    modalCadastro.classList.remove('modalCadastro');
    modalCadastro.classList.add('modalCadastroActive');
    console.log("Abrindo");
}

function fecharModal() {
    modalCadastro.classList.remove('modalCadastroActive');
    modalCadastro.classList.add('modalCadastro');
}

// Verifica se o texto bate
if (cadastradoSucesso === "Cadastro realizado com sucesso") {
    abrirModal();
}

// Adiciona o evento de clique ao botão
btnFecharCadastro.addEventListener('click', fecharModal);
