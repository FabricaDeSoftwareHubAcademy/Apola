


document.addEventListener('DOMContentLoaded', async function () {
    
    let botoesStatus = document.querySelectorAll('.btn_item_listar_produtos')
    
    let quantValue = document.querySelectorAll('.n_item_dados_produto');
    let quantytotal = Array.from(quantValue).find(el => el.getAttribute('data-status') === 'todos');
    let quantyAtivos = Array.from(quantValue).find(el => el.getAttribute('data-status') === 'ativos');
    let quantyinativos = Array.from(quantValue).find(el => el.getAttribute('data-status') === 'inativos');
    
    botoesStatus.forEach(elemento =>{
        elemento.addEventListener('click',async (event) => {
            const returns = await handleTablesProdutos(event);
            argumento = returns.argumento

            quantValue.forEach(e => e.style.color = '#ccc')
            Array.from(quantValue)
            .find(elemento => elemento.getAttribute("data-status") === argumento)
            .style.color = "#000";

            
            // console.log(returns.argumento.includes(1).getAttribute('data-status'))
            // quantValue.find(e => returns.argumento.includes().getAttribute ).style.fontWeight = 'bold'
        })
    })

    const quantidades = await handleTablesProdutos();   
    console.log(quantidades)
    quantytotal.innerText = quantidades.total;
    quantyinativos.innerText = quantidades.inativo;
    quantyAtivos.innerText = quantidades.ativo;


    var  pesquisa = document.getElementById('input_search')
    pesquisa.addEventListener('input', function () {
    const searchInput = this.value.trim();

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../../App/Session/carrega_tabela_produtos.php?search=${encodeURIComponent(searchInput)}`, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const dados = JSON.parse(xhr.responseText);
            const table = document.getElementById('dados_produtos');
            table.innerHTML = '';

            if (Array.isArray(dados) && dados.length > 0) {
                dados.forEach(e => {
                    table.innerHTML += `<tr>
                        <td><img src='${e.imagem}' alt="Imagem" style="max-width:100px; max-height:50px;"></td>
                        <td>${e.nome}</td>
                        <td>${e.preco}</td>
                        <td>${e.tipo}</td>
                        <td>${e.status_produto == "a" ? "ativado" : "inativado"}</td>
                        <td>
                            <div class="container_item_list_ações">
                                <a href="produtos_adm.php?id=${e.id_produto}"><i class="fa-solid fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>`;
                });
            } else {
                table.innerHTML = '<br><tr><td colspan="6">Nenhum resultado encontrado</td></tr></br>';
            }
        }
    };
    xhr.send();
});

});

async function handleTablesProdutos(event=null){
    if(event){
        
    }

    let table = document.getElementById('dados_produtos')
    if(table){

        table.innerHTML = ""
    }

    let args = event && event.target.getAttribute("data-status") != '' ?   event.target.getAttribute("data-status") : null;
    // console.log(args)
    try{
        let dados_php = await fetch(`../../App/Session/carrega_tabela_produtos.php?status=${args ? args : ""}`);
        let response = await dados_php.json();
        
        response.forEach(e =>{
            table.innerHTML +=`<td><img src='${e.imagem}' alt="Imagem" style="max-width:100px; max-height:50px;"></td>
            <td>${e.nome}</td>
            <td>${e.preco}</td>
            <td>${e.tipo}</td>
            <td>${e.status_produto == "a" ? "ativado" : "inativado"}</td>
            <td>
                   <div class="container_item_list_ações">
                        <a href="produtos_adm.php?id=${e.id_produto}"><i class="fa-solid fa-eye"></i></a>
                    </div>
            </td>
            `;  
        })
        
        
        return {
            total: response.length,
            inativo: response.filter(e => e.status_produto === 'i').length,
            ativo: response.filter(e => e.status_produto === 'a').length,

            argumento: args
        }
        
    }
    catch(erro){

    }
   
}

