async function carregarContadores() {
    try {
        const res = await fetch('../../App/Session/get_pedidos_status_count.php');
        const counts = await res.json();

        document.querySelectorAll('p.n_item_dados[data-status-pedido]').forEach(p => {
            const status = p.getAttribute('data-status-pedido');
            if (status === "total") {
                p.textContent = `N° ${counts.total}`;
            } else if (status === "pagar") {
                p.textContent = `N° ${counts["A pagar"]}`;
            } else if (status === "producao") {
                p.textContent = `N° ${counts["Produção"]}`;
            } else if (status === "envio") {
                p.textContent = `N° ${counts["Envio"]}`;
            } else if (status === "entregue") {
                p.textContent = `N° ${counts["Entregue"]}`;
            }
        });
    } catch (error) {
        console.error("Erro ao carregar contadores:", error);
    }
}

// Chamar junto com a tabela
load_table();
carregarContadores();

function filtrarPedidos(status) {
    fetch('../../App/Session/carrega_tabela_pedido.php?status=' + encodeURIComponent(status))
        .then(response => response.json())
        .then(data => {
            let tabela = document.getElementById('dados');
            let html = '';

            data.forEach(pedido => {
                let valorTratado = pedido.Valor;
                if (!valorTratado || valorTratado === null) {
                    valorTratado = '0.00';
                }
                html += `<tr>
                    <td>${pedido.ID}</td>
                    <td>${valorTratado}</td>
                    <td>${pedido.Tipo}</td>
                    <td>${pedido.UF}</td>
                    <td>`;

                if (pedido.Tipo === "disponivel") {
                    html += `<div class="container_item_list_ações">
                                <a href="pedido_disponivel_adm.php?search=${pedido.ID}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>`;
                } else if (pedido.Tipo === "personalizado") {
                    html += `<div class="container_item_list_ações">
                                <a href="pedido_personalizado_adm.php?search=${pedido.ID}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>`;
                }

                html += `</td></tr>`;
            });

            if (html === '') {
                html = `<tr><td colspan="5"> Nenhum resultado encontrado </td></tr>`;
            }

            tabela.innerHTML = html;
        })
        .catch(error => {
            console.error('Erro ao carregar pedidos:', error);
        });
}

async function load_table(){
    
    let dados_tabela = document.getElementById('dados')
    let html = "";

    let dados_php = await fetch('../../App/Session/carrega_tabela_pedido.php');
    let response = await dados_php.json();
    // console.log(response);
    for(var i = 0; i < response.length; i++){
        html += '<tr>';
        html += '<td>';
        html += response[i].ID;
        html += '<td>';
        html += response[i].Valor ?? '0.00';
        html += '<td>';
        html += response[i].Tipo;
        html += '<td>';
        html += response[i].UF;
        html += '<td>';
        if (response[i].Tipo === "disponivel"){
            html += '<div class="container_item_list_ações">';
            html += `<a href="pedido_disponivel_adm.php?search=${response[i].ID}"><i class="fa-solid fa-eye"></i></a>`;
        }
        if (response[i].Tipo === "personalizado"){
            html += '<div class="container_item_list_ações">';
            html += `<a href="pedido_personalizado_adm.php?search=${response[i].ID}"><i class="fa-solid fa-eye"></i></a>`;
        }
    }
    dados_tabela.innerHTML = html;
}
// Seleciona todos os botões pela classe
const buttons = document.querySelectorAll('.btn_item_listar_adm');
// Adiciona o evento de clique a cada botão
buttons.forEach(button => {
    button.addEventListener('click', () => {
        console.log(`Botão "${button.textContent}" clicado`);
        // alert("olá")
        // Remove os estilos dos outros botões
        buttons.forEach(btn => {
            if(btn != button){
                btn.style.color = '';
                btn.style.backgroundColor = '';
            }
        });

        // Adiciona os estilos ao botão clicado
        button.style.backgroundColor = 'white';
        button.style.color = '#4A4A4A';
    });
});

var pesquisa = document.getElementById('input_search');
pesquisa.addEventListener('input', function () {
    const searchInput = this.value.trim();

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../../App/Session/carrega_tabela_pedido.php?search=${encodeURIComponent(searchInput)}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const dados = JSON.parse(xhr.responseText);
            const table = document.getElementById('dados');
            let html = '';

            if (Array.isArray(dados) && dados.length > 0) {
                dados.forEach(e => {
                    html += '<tr>';
                    html += '<td>';
                    html += e.ID;
                    html += '<td>';
                    html += e.Valor ?? '0.00';
                    html += '<td>';
                    html += e.Tipo;
                    html += '<td>';
                    html += e.UF;
                    html += '<td>';
                    if (e.Tipo === "disponivel"){
                        html += '<div class="container_item_list_ações">';
                        html += `<a href="pedido_disponivel_adm.php?search=${e.ID}"><i class="fa-solid fa-eye"></i></a>`;
                    }
                    if (e.Tipo === "personalizado"){
                        html += '<div class="container_item_list_ações">';
                        html += `<a href="pedido_personalizado_adm.php?search=${e.ID}"><i class="fa-solid fa-eye"></i></a>`;
                    }
                    console.log(dados)
                });
            } else {
                html += '<tr><td colspan="6">Nenhum resultado encontrado</td></tr>';
            }

            table.innerHTML = html;
        }
    };
    xhr.send();
});
