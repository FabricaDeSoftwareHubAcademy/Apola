

document.addEventListener('DOMContentLoaded', async function () {
    
    let botoesStatus = document.querySelectorAll('.btn_item_listar_categorias')

    let quantValue = document.querySelectorAll('.n_item_dados_categoria');
    let quantytotal = Array.from(quantValue).find(el => el.getAttribute('data-status') === 'todos');
    let quantyAtivos = Array.from(quantValue).find(el => el.getAttribute('data-status') === 'ativos');
    let quantyinativos = Array.from(quantValue).find(el => el.getAttribute('data-status') === 'inativos');
    
    botoesStatus.forEach(elemento =>{
        elemento.addEventListener('click',async (event) => {
            const returns = await handleTablesCategorias(event);
            argumento = returns.argumento
            


            quantValue.forEach(e => e.style.color = '#ccc')
            Array.from(quantValue)
            .find(elemento => elemento.getAttribute("data-status") === argumento)
            .style.color = "#000";

            
            // console.log(returns.argumento.includes(1).getAttribute('data-status'))
            // quantValue.find(e => returns.argumento.includes().getAttribute ).style.fontWeight = 'bold'
        })
    })
    const quantidades = await handleTablesCategorias();
    console.log(quantidades)
    quantytotal.innerText = quantidades.total;
    quantyinativos.innerText = quantidades.inativo;
    quantyAtivos.innerText = quantidades.ativo;

    let inputSearch = document.getElementById('input_search');
    let table = document.getElementById('dados_categoria');

    inputSearch.addEventListener('input', function () {
        const searchTerm = inputSearch.value.trim();

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `../../App/Session/carrega_tabela_categorias.php?search=${encodeURIComponent(searchTerm)}`, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    table.innerHTML = '';

                    if (response.length === 0) {
                        table.innerHTML = `<tr><td colspan="5" style="text-align:center;">Nenhum resultado encontrado.</td></tr>`;
                        return;
                    }

                    response.forEach(e => {
                        table.innerHTML += `
                            <tr>
                                <td><img src='${e.imagem}' alt="Imagem" style="max-width:100px; max-height:50px;"></td>
                                <td>${e.id_categoria}</td>
                                <td>${e.nome}</td>
                                <td>${e.status_categoria == "a" ? "ativado" : "inativado"}</td>
                                <td>
                                    <div class="container_item_list_ações">
                                        <a href="categoria_adm.php?id=${e.id_categoria}"><i class="fa-solid fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>`;
                    });
                } catch (err) {
                    console.error('Erro ao processar JSON:', err);
                }
            } else {
                console.error('Erro na requisição. Status:', xhr.status);
            }
        };

        xhr.onerror = function () {
            console.error('Erro na requisição Ajax.');
        };

        xhr.send();
    });
});

async function handleTablesCategorias(event=null){
    if(event){

    }

    let table = document.getElementById('dados_categoria')
    if(table){

        table.innerHTML = ""
    }
    let args = event && event.target.getAttribute("data-status") != '' ?  event.target.getAttribute("data-status") : null;

    try{
        let dados_php = await fetch(`../../App/Session/carrega_tabela_categorias.php?status=${args ? args : ""}`);
        let response = await dados_php.json();

        response.forEach(e =>{
            table.innerHTML +=`<td><img src='${e.imagem}' alt="Imagem" style="max-width:100px; max-height:50px;"></td>
            <td>${e.id_categoria}</td>
            <td>${e.nome}</td>
            <td>${e.status_categoria == "a" ? "ativado" : "inativado"}</td>
            <td>
                   <div class="container_item_list_ações">
                        <a href="categoria_adm.php?id=${e.id_categoria}"><i class="fa-solid fa-eye"></i></a>
                    </div>
            </td>
            `;

        })
        
        return{
            total: response.length,
            inativo: response.filter(e => e.status_categoria === 'i').length,
            ativo: response.filter(e => e.status_categoria === 'a').length,

            argumento: args
        }
        
    }
    catch(erro){

    }
    
}
document.addEventListener('DOMContentLoaded', function () {
   

    inputSearch.dispatchEvent(new Event('input'));
});
