$(function(){

    // data-placement="top" \
    // data-original-title="Tooltip on top"
    // imagem.tooltip();

    $.fn.gallery = function(command) {

        var command = (typeof command != 'undefined') ? command : 'undefined';     

        return this.each(function(index, el) {

            var gallery = $(el);
            var modal = $('.modal', gallery);
            var body = $('.modal-body', modal);
            var url_site = $(el).data('url-site');
            var url_base = $(el).data('url-base');
            var ref_id = $(el).data('relation-ref-id');
            var position_id = 0;            

            // adiciona a imagem ao body
            var addImage = function(imagem){
                position_id++;
                imagem.attr('data-position-id', position_id);

                //
                body.append(imagem);
            }

            //
            var changeImage = function(imagem, position_id){
               var old = $('.image[data-position-id='+position_id+']', body);
               imagem.attr('data-position-id', position_id);
               old.replaceWith(imagem);
            }

            // cria uma imagem
            var createImage = function(file, position_id){

                var small = url_site + '/bw-small/' + file.filename;
                var original = url_site + '/original/' + file.filename;
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
                        var jqxhr = $.getJSON(url_base + '/' + file.id + '/remove');
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
                $('.btn-move', imagem).on('click', function(){
                    alert('move');
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
                    url: url_base + '/upload',
                    formData: {},
                    dataType: 'json',
                    replaceFileInput: false,
                    sequentialUploads: true,
                    singleFileUploads: true,

                    add: function (e, data){

                        $.each(data.files, function(index, file) {
                            createNewImage();

                            data.formData = {
                                'position': position_id
                            };
                        
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
                        console.log(e);
                        console.log(data);
                        var porcent = parseInt(data.loaded / data.total * 100, 10);
                        $('.progress-porcent:first', el).html(porcent + '%');
                    },

                    //
                    always: function (e, data, jqXHR) {}
                });
            };

            //
            var getAllImages = function(){
                var jqxhr = $.getJSON(url_base);
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
                            url: url_base + '/reorder',
                            data: { 'images': images, 'positions': positions},
                            dataType: "json"
                        });

                    }
                });

                body.disableSelection();
            }

            console.log(command);

            switch(command) {
                case 'open':
                    getAllImages();
                    break;

                case 'undefined':
                    getAllImages();
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

}( jQuery ));
