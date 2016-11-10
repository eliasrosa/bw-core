$(function(){
    $('form .field-image .btn-remove').on('click', function() {
        if(!confirm('Tem certeza que deseja remover esta imagem?')){
            return false;
        }
    });
});
