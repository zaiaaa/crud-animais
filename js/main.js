// $('#delete-modal').on('show.bs.modal', function (event) {
  
//     var button = $(event.relatedTarget);
//     var id = button.data('customer');
    
//     var modal = $(this);
//     modal.find('.modal-title').text('Excluir Cliente #' + id);
//     modal.find('#confirm').attr('href', 'delete.php?id=' + id);
// })


//TELEFONE MASC
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function id( el ){
	return document.getElementById( el );
}
window.onload = function(){
	id('telefone').onkeyup = function(){
		mascara( this, mtel );
	}

    id('celular').onkeyup = function(){
		mascara( this, mtel );
	}
}







const modal = document.querySelector(".modal");

modal.addEventListener("show.bs.modal", (event) =>{
    const button = event.relatedTarget;
    const id = button.getAttribute("data-bs-custumer");
    const titulo = document.querySelector(".modal-title");
    const confirmButton = modal.querySelector('#confirm');

    titulo.innerText = 'Excluir registro #' + id;
    confirmButton.setAttribute('href', 'delete.php?id=' + id)


})
