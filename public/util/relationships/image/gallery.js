$(function(){

    // data-placement="top" \
    // data-original-title="Tooltip on top"
    // imagem.tooltip();

    $.fn.gallery = function(command) {

        var command = (typeof command != 'undefined') ? command : 'init';     

        return this.each(function(index, el) {

            //
            var gallery = $(el);
            var modal = $('.modal', gallery);
            var body = $('.modal-body', modal);
            
            // urls
            var url_images = $(el).data('url-images');
            var url_gallery = $(el).data('url-gallery');
            var url_remove = $(el).data('url-remove');
            var url_reorder = $(el).data('url-reorder');
            var url_upload = $(el).data('url-upload');

            // dados comuns
            var common_data = {
                relation_id: $(el).data('relation-id'),
                ref_id: $(el).data('relation-ref-id'),
            };

            // posição inicial das imagens
            var position_id = 0;            

            // function
            // adiciona a imagem ao body
            var addImage = function(imagem){
                position_id++;
                imagem.attr('data-position-id', position_id);

                //
                body.append(imagem);
            }

            // function
            // reorganiza as posições das imagens
            var changeImage = function(imagem, position_id){
               var old = $('.image[data-position-id='+position_id+']', body);
               imagem.attr('data-position-id', position_id);
               old.replaceWith(imagem);
            }

            // function
            // cria uma imagem
            var createImage = function(file, position_id){

                var small = url_images + '/bw-small/' + file.filename;
                var original = url_images + '/original/' + file.filename;
                var imagem = $('<div class="image" data-id="' + file.id + '">\
                                    <img src="' + small + '" />\
                                    <div class="options"> \
                                        <span class="fa fa-trash btn btn-danger btn-xs btn-trash"></span>\
                                        <span class="fa fa-arrows-alt btn btn-success btn-xs btn-move"></span>\
                                        <a href="' + original + '" target="_blank" class="fa fa-search-plus btn btn-primary btn-xs btn-zoom"></a>\
                                    </div>\
                                </div>');


                // cria o evento de remoção
                $('.btn-trash', imagem).on('click', function(){
                    if(confirm('Tem certeza que deseja remover esta imagem?')){
                        var jqxhr = $.getJSON(url_remove, $.extend(common_data, { id: file.id }));
                        jqxhr.done(function(json) {
                            if(json.error){
                                alert(json.message);
                            }else{
                                $('div.image[data-id='+file.id+']').remove();

                                //
                                var count = $('.image', body).length;
                                if(count == 0){
                                    $('.empty', body).show();
                                }
   
                            }
                        })
                    }

                });

                //
                if(position_id){
                    changeImage(imagem, position_id)
                }else{
                    addImage(imagem);
                }
            };

            // cria uma imagem nova
            var createNewImage = function(id){
                $('.empty', body).hide();

                var imagem = $('<div class="image"><span class="progress-porcent">0%</span></div>');
                addImage(imagem);
            }

            // cria o evento de upload
            var createEventUpload = function(){
                $("input[type=file]", el).fileupload({
                    url: url_upload,
                    formData: {},
                    dataType: 'json',
                    replaceFileInput: false,
                    sequentialUploads: true,
                    singleFileUploads: true,

                    add: function (e, data){

                        $.each(data.files, function(index, file) {
                            createNewImage();

                            data.formData = $.extend({
                                'position': position_id
                            }, common_data);
                        
                            var jqXHR = data.submit()
                                .success(function (result, textStatus, jqXHR) {})
                                .error(function (jqXHR, textStatus, errorThrown) {})
                                .complete(function (result, textStatus, jqXHR) {
                                    var data = result.data;
                                    if(result.error){
                                        // createErrorImage();
                                    }else{
                                        createImage(data, data.position);
                                    }
                                });
                        });
                    },

                    //
                    progress: function (e, data) {
                        var porcent = parseInt(data.loaded / data.total * 100, 10);
                        $('.progress-porcent:first', el).html(porcent + '%');
                    },

                    //
                    always: function (e, data, jqXHR) {}
                });
            };

            //
            var loadImages = function(){
                var jqxhr = $.getJSON(url_gallery, common_data);
                jqxhr.done(function(json) {

                    //
                    $('.loading', body).hide();

                    //
                    if(json.data.length){
                        $.each(json.data, function(i, image){
                            createImage(image, false);
                        });
                    }else{
                        $('.empty', body).show();
                    }

                });
            };

            //
            var createEventDropAndDrag = function(){
                body.sortable({
                    itens: '.image',
                    cancel: ".loading, .empty",
                    placeholder: 'ui-state-highlight',
                    forcePlaceholderSize: true,
                    handle: ".btn-move",
                    update: function(){
                        
                        var images=[];
                        var positions=[];
                        position_id = 0;
                        $('.image', body).each(function(k, i){
                            position_id++;

                            //
                            images.push($(i).data('id'));
                            positions.push(position_id);

                            //
                            $(i).attr('data-position-id', position_id);
                        });

                        $.ajax({
                            type: "POST",
                            url: url_reorder,
                            data: $.extend({ 
                                'images': images,
                                'positions': positions
                            }, common_data),
                            dataType: "json"
                        });

                    }
                });

                body.disableSelection();
            }

            switch(command) {
                case 'open':
                    loadImages();
                    break;

                case 'init':
                    createEventUpload();
                    createEventDropAndDrag();
                    break;
            }
        });
    };

    // Modal
    //////////////////////////////////////////////////
    $(".field-gallery .modal").on("show.bs.modal", function(e) {
        
        // .remove as imagens
        $('.image', this).remove();

        // hide .empty
        $('.empty', this).hide();

        // show .loading
        $('.loading', this).show();

        // load all images
        $(this).parent(".field-gallery").gallery('open');
    });

    // Open gallery
    //////////////////////////////////////////////////
    $('form .field-gallery').each(function(index, el){
        var gallery = $(el);
        var modal = $('.modal', gallery);

        $('.btn-open-gallery-images', gallery).on('click', function(){
           modal.modal('show');
        });

        //
        gallery.gallery();
    });

});
