$(function(){

    // classname: danger, warning, info, success
    $.bwAlert = function(message, classname){
        var html = ' \
            <div class="alert alert-' + classname + '"> \
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> \
                ' + message + ' \
            </div>';

        $(html).hide().prependTo('#page-wrapper').slideDown();
    };

}( jQuery ));
