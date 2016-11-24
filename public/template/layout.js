$(function() {

    // ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // sidebar levels
    $('#sidebar-wrapper .sidebar-nav').metisMenu();

    // show flash message
    $('#flash-overlay-modal').modal();

    // open sidebar
    $("#btn-slidemenu").on('click', function(e) {
        $('#sidebar-wrapper').toggleClass('toggled');
    });

    // close sidebar
    $('#sidebar-wrapper .sidebar-brand').on('click', function(event) {
        $('#sidebar-wrapper').toggleClass('toggled');
    });

    // dataTable - pt-br
    $.extend( true, $.fn.dataTable.defaults, {
        'language': {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Exibindo de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Exibindo 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Exibir _MENU_ registros por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });

    // dataTable
    $('#page-wrapper .datatable-simple')
        .addClass('table table-hover table-striped');


    //
    $('table form .btn-remove-record').on('click', function() {
        if(!confirm('Tem certeza que deseja remover este registro?')){
            return false;
        }
    });
});
