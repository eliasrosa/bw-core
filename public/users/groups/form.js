$(function() {


    var super_admin = function(checkbox, speed){

        //
        var permissions = $('#permissions');
        var text_super_admin = $('#text_super_admin');

        //
        if(checkbox.prop('checked')){
            permissions.slideUp(speed, function(){
                text_super_admin.slideDown(speed);
            });
        }else{
            text_super_admin.slideUp(speed, function(){
                permissions.slideDown(speed);
            });
        }
    };

    //
    $('input[name="super_administrator"]').change(function() {
        super_admin($(this), 'slow');
    });

    //
    super_admin($('input[name="super_administrator"]'), 0);
});
