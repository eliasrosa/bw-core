$(function(){

    $.fn.image = function() {

        return this.each(function(index, el) {

            var url_site = $(el).data('url-site');
            var url_base = $(el).data('url-base');
            var ref_id = $(el).data('relation-ref-id');
            var data = {}

            //
            var createEventUpload = function(){

                $("input[type='file']", el).fileupload({
                    url: url_base + '/upload',
                    formData: {},
                    dataType: 'json',
                    replaceFileInput: false,

                    start: function (e, data){
                        createHtmlProgressBar();
                    },

                    //
                    progress: function (e, data) {
                        var porcent = parseInt(data.loaded / data.total * 100, 10);
                        $('.progress .progress-bar', el).css('width', porcent + '%');
                        $('.progress-porcent', el).html(porcent + '%');
                    },

                    //
                    always: function (e, data, jqXHR) {
                        if(data.result.error){
                            $.bwAlert(data.result.message, 'danger');
                        }else{
                            $.bwAlert(data.result.message, 'success');
                        }

                        getImage();
                    }
                });
            };

            //
            var createHtmlNoImage = function(){

                var html = ' \
                <div class="image fa fa-image"></div> \
                <div class="options"> \
                    <input name="imagem" type="file" accept="image/jpeg, image/png, image/bmp"> \
                </div>';

                //
                $(el).html(html);

                //
                createEventUpload();
            };

            //
            var createHtmlProgressBar = function(){

                var html = ' \
                <div class="progress">\
                    <div class="progress-bar" role="progressbar"></div> \
                </div> \
                <div>Enviando imagem... <span class="progress-porcent">0%<span></div>';

                //
                $(el).html(html);
            };

            //
            var createHtml = function(){

                var html = ' \
                <div class="image" style="background: #FFF url(' + url_site + '/bw-small/' + data.filename + ') no-repeat center center"></div> \
                <div class="options"> \
                    <a href="' + url_site + '/download/' + data.filename + '" class="btn btn-success btn-xs"><span class="fa fa-download"></span> Download</a> \
                    <a href="' + url_site + '/original/' + data.filename + '" class="btn btn-primary btn-xs" target="_blank"><span class="fa fa-image"></span> Exibir original</a> \
                    <a href="' + url_base + '/remove" class="btn btn-danger btn-remove btn-xs"><span class="fa fa-trash-o"></span> Remover imagem</a> \
                    <input name="imagem" type="file" accept="image/jpeg, image/png, image/bmp"> \
                </div>';

                //
                $(el).html(html);

                // create event - remove
                $('.btn-remove', el).on('click', function() {
                    if(confirm('Tem certeza que deseja remover esta imagem?')){
                        //
                        var jqxhr = $.getJSON(url_base  + '/remove');

                        //
                        jqxhr.done(function(json) {

                            if(json.error){
                                $.bwAlert(json.message, 'danger');
                            }else{
                                $.bwAlert(json.message, 'success');
                            }

                            getImage();
                        })
                    }

                    return false;
                });

                //
                createEventUpload();
            };

            //
            var getImage = function(){

                if(ref_id){

                    //
                    var jqxhr = $.getJSON(url_base);

                    //
                    jqxhr.done(function(json) {
                        data = json.data;

                        if(json.error){
                            createHtmlNoImage();
                        }else{
                            createHtml();
                        }
                    });
                }else{
                    var html = '<p>Para enviar a imagem, salve o formulário antes.</p>';

                    //
                    $(el).html(html);
                }
            };

            //
            getImage();
        });

    };

    $('form .field-image').image();

}( jQuery ));
