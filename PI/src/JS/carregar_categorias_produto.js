document.addEventListener('DOMContentLoaded', function () {
    const dadosCat = document.getElementById('dadosTodasCategoria');
    let html = '';

    async function load_categorias() {
        try {
            let dados_php = await fetch('../../App/Session/carregar_categorias_ativadas.php');
            let response = await dados_php.json();

            for (let i = 0; i < response.length; i++) {
                let categoria = response[i];
                let selected = (typeof categoriaSelecionada !== 'undefined' && categoria.id_categoria == categoriaSelecionada) ? 'selected' : '';
                html += `<option value="${categoria.id_categoria}" ${selected}>${categoria.nome}</option>`;
            }

            dadosCat.innerHTML = html;

        } catch (error) {
            console.error("Erro ao carregar categorias:", error);
            dadosCat.innerHTML = "<option>Erro ao carregar categorias</option>";
        }
    }

    load_categorias();
});
