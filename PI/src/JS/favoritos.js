document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".input-check");

    checkboxes.forEach(check => {
        check.addEventListener('click', () => {
            const productId  = check.getAttribute('data-id');
            let favoritos = check.getAttribute('data-status');

            if(favoritos === 'a'){
                favoritos = 'a';
                
            } else {
                favoritos = 'i';
            }

            console.log(`STATUS DE FAVORITOS DO PRODUTO (a enviar): ${favoritos}`);
            console.log(`ID DO PRODUTO (a enviar): ${productId}`);


            $.ajax({
                url: "../../App/Actions/favoritos.php",
                method: "GET", 
                data: { 
                    IdProduct: productId,
                    Statusfavorito: favoritos 
                }
            }).done(function(response) {
                console.log("Resposta do PHP:", response.success);

                if(response.success){
                    favoritos= 'a'
                    check.setAttribute('data-status', favoritos);
                    check.checked = (favoritos === true);
                }

                if(response.type == 'excluir'){
                    favoritos= 'i'
                    check.setAttribute('data-status', favoritos);
                    check.checked = (favoritos === false);
                }
                

            }).fail(function() {
             
                check.checked = (check.getAttribute('data-status') === 'a');
            });
        });
    });
});
