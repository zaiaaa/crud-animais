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
function mcpf(v){
    // Remove tudo o que não é dígito
    v = v.replace(/\D/g, '');

    // Verifica se é CPF (11 dígitos) ou CNPJ (14 dígitos)
    if (v.length <= 11) {
        // Formato para CPF
        v = v.replace(/^(\d{3})(\d)/, '$1.$2');
        v = v.replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
        v = v.replace(/(\d{3})\.(\d{3})\.(\d{3})(\d{1,2})$/, '$1.$2.$3-$4');
    } else {
        // Formato para CNPJ
        v = v.replace(/^(\d{2})(\d)/, '$1.$2');
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        v = v.replace(/\.(\d{3})(\d)/, '.$1/$2');
        v = v.replace(/(\d{4})(\d)/, '$1-$2');
    }

    return v;
}
function muf(v) {
    // Remove qualquer caractere não alfabético
    v = v.replace(/[^a-zA-Z]/g, '');
    // Converte para maiúsculas
    v = v.toUpperCase();
    // Limita o tamanho da entrada para 2 caracteres (tamanho máximo de uma sigla de UF)
    v = v.slice(0, 2);
    return v;
}
function mie(v) {
    // Remove todos os caracteres não numéricos
    v = v.replace(/\D/g, '');
    
    // Define o formato da máscara de acordo com a quantidade de caracteres
    if (v.length <= 9) {
        // Formato para inscrições estaduais com até 9 dígitos
        v = v.replace(/^(\d{3})(\d{3})(\d{3})$/, '$1.$2.$3');
    } else {
        // Formato para inscrições estaduais com mais de 9 dígitos
        v = v.replace(/^(\d{3})(\d{3})(\d{3})(\d{1,3})$/, '$1.$2.$3/$4');
    }
    
    return v;
}
function mcep(v) {
    // Remove todos os caracteres não numéricos
    v = v.replace(/\D/g, '');
    
    // Formato com 5 dígitos
    if (v.length <= 5) {
        v = v.replace(/^(\d{5})/, '$1');
    }
    // Formato com 5 dígitos + hífen + 3 dígitos
    else {
        v = v.replace(/^(\d{5})(\d{1,3})/, '$1-$2');
    }

    return v;
}

window.onload = function(){
	id('telefone').onkeydown = function(){
		mascara( this, mtel );
	}

    id('celular').onkeydown = function(){
		mascara( this, mtel );
	}

    id('cpf').onkeydown = function(){
        mascara(this, mcpf);
    }   

    id('uf').onkeydown = function(){
        mascara(this, muf);
    }

    id('ie').onkeydown = function(){
        mascara(this, mie)
    }

    id('cep').onkeydown = function(){
        mascara(this, mcep)
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
