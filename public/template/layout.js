$(function() {

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
});
