// const { EVENT_REFRESH } = require("@splidejs/splide");
function atualizarContador() {
    const textarea = document.getElementById("mensagem");
    const contador = document.getElementById("contador");
    contador.textContent = textarea.value.length;
}
let form = document.getElementById("formulario_avaliacao")

let modal1 = document.querySelector('.modal-sobre-nois-avaliado')
let modal2 = document.querySelector('.modal-sobre-nois-not-avaliado')
let modal3 = document.querySelector('.modal-sobre-nois-sem-estrela')
const idCliente = sessionStorage.getItem('idcliente')
function aparecerModal1() {
    modal1.classList.remove('modal-sobre-nois-avaliado')
    modal1.classList.add('modal-sobre-nois-avaliado-ative')
    setTimeout(() => {
        modal1.classList.remove('modal-sobre-nois-avaliado-ative')
        modal1.classList.add('modal-sobre-nois-avaliado')

        window.location.reload()
    }, 3000)
}
function aparecerModal2(){
    modal2.classList.remove('modal-sobre-nois-not-avaliado')
    modal2.classList.add('modal-sobre-nois-not-avaliado-ative')

    setTimeout(() => {
        modal2.classList.remove('modal-sobre-nois-not-avaliado-ative')
        modal2.classList.add('modal-sobre-nois-not-avaliado')
    }, 6000)
    
}
function aparecerModal3(){
    modal3.classList.remove('modal-sobre-nois-sem-estrela')
    modal3.classList.add('modal-sobre-nois-sem-estrela-ative')

    setTimeout(()=>{
        modal3.classList.remove('modal-sobre-nois-sem-estrela-ative')
        modal3.classList.add('modal-sobre-nois-sem-estrela')

    }, 4000)
}



async function handleAvaliacoesSobreNois(event=null){
    let avaliacoes = document.getElementById('carregar-avaliacoes-sobre-nois')
    // console.log(avaliacoes)   
    try{
        let dados_avaliacoes = await fetch('../../App/Session/carregar_avaliacao.php')
        let response = await dados_avaliacoes.json()
        // console.log("Aquii" +response)
        response.forEach(e => {
            let estrelasHTML = "";
        
            for (let i = 0; i < e.notas; i++) {
                estrelasHTML += `<i class="fa-solid fa-star"></i>`;
            }
        
            avaliacoes.innerHTML += `
            <div class="comentario swiper-slide">
                <img class="avatar" src="${e.foto_perfil}" alt="Foto de ${e.nome}"/>
                <p class="nome">${e.nome}  ${e.sobrenome}</p>
                <div class="comentario-texto">
                    <p class="justificar-texto">${e.comentario}</p>
                </div>
        
                <div class="content_star_sobre">
                    ${estrelasHTML}
                </div>
            </div>`;
        });
    }
    catch(erro){

    }
}




handleAvaliacoesSobreNois()
form.addEventListener("submit" , e =>{
    e.preventDefault()
    
    if(idCliente){
        const formulario = new FormData(form)

        const [nota, comentario] = formulario.values();

        const bodyRequest ={
            notas: nota ,
            comentario: comentario,
            id_cliente: idCliente
        } 
        const caminho = '../../App/Session/inserir_avaliacoes.php';
        

        fetch(caminho, {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json'
                },
                body: JSON.stringify(bodyRequest)
                })
                .then(response => response.json())
                .then(data => {
                    // console.log("Sucesso!!!!!!!", data)
                    aparecerModal1()
                })
                .catch((error)  => {
                        // console.log('Error', error)
                        aparecerModal3()
                })
    }else{
        aparecerModal2()
    }
})
