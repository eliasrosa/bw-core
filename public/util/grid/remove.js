$(function(){
    $('form :submit[value="Remover"]').on('click', function() {
        if(!confirm('Tem certeza remover esse registro?')){
            return false;
        }
    });
});
