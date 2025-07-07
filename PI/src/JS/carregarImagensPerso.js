let formulario = document.getElementById('quadro');
let textoInserido = document.getElementById('mensagem');
const imgInp = document.getElementById('imgInput');
const previewContainer = document.getElementById('preview_img');
const alertBox = document.getElementById('alert');
const maxImages = 4;

let modalPerso = document.querySelector('.modal-enviado');
let btnFecharModal = document.querySelector('.btn-fechar-modal');

btnFecharModal.addEventListener('click', function() {
  modalPerso.classList.remove("modal-enviado-active");
  modalPerso.classList.add("modal-enviado");
});

function abrirModal(){
  console.log("Abrindo modal...");
  modalPerso.classList.remove("modal-enviado");
  modalPerso.classList.add("modal-enviado-active");
}

let selectedFiles = [];

imgInp.addEventListener('change', () => {
  const newFiles = Array.from(imgInp.files);
  const totalFiles = selectedFiles.length + newFiles.length;

  if (totalFiles > maxImages) {
    alertBox.textContent = `Você só pode enviar até ${maxImages} imagens.`;
    imgInp.value = "";
    return;
  }

  selectedFiles = selectedFiles.concat(newFiles);
  previewContainer.innerHTML = '';
  alertBox.textContent = '';

  selectedFiles.forEach((file, index) => {
    const img = document.createElement('img');
    img.src = URL.createObjectURL(file);
    img.classList.add('image-preview-item');
    img.title = `Imagem ${index + 1}`;
    previewContainer.appendChild(img);
  });

  imgInp.value = "";
});
formulario.addEventListener('submit', e => {
  e.preventDefault();

  const msg = document.getElementById("msg");
  const img = document.getElementById("img");

  msg.textContent = "";
  img.textContent = "";

  let valorMensagem = textoInserido.value.trim(); // remove espaços extras

  // Validação
  if (valorMensagem.length < 1) {
    msg.textContent = "Insira uma descrição";
    return;
  }

  if (!selectedFiles || selectedFiles.length === 0) {
    img.textContent = "Insira alguma imagem";
    return;
  }

  const formData = new FormData();
  formData.append('mensagem', valorMensagem);

  selectedFiles.forEach((file) => {
    formData.append('imagens[]', file);
  });

  const caminhoFetch = '../../App/act/enviarPersonalizado.php';

  fetch(caminhoFetch, {
    method: 'POST',
    body: formData,
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      abrirModal();
      textoInserido.value = '';
      selectedFiles = [];
      previewContainer.innerHTML = '';
    } else {
      // alertBox.textContent = 'Erro: ' + data.message;
    }
  })
  .catch(error => {
    console.error('Erro ao enviar:', error);
    alertBox.textContent = 'Erro ao enviar. Tente novamente.';
  });
});
