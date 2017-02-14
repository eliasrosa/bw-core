$(function(){

    $.fn.galery = function() {

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
                                $('div.image[data-id='+file.id+']').fadeOut();
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
                var imagem = $('<div class="image"><span class="progress-porcent">0%</span></div>');
                addImage(imagem);
            }

// data-placement="top" \
// data-original-title="Tooltip on top"
// imagem.tooltip();


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
                        var porcent = parseInt(data.loaded / data.total * 100, 10);
                        $('.progress-porcent', el).html(porcent + '%');
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
                    $.each(json.data, function(i, image){
                        createImage(image, false);
                    });

                });
            };

            //
            var createEventDropAndDrag = function(){
                body.sortable({
                    itens: '.image',
                    cancel: ".loading",
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

            //
            getAllImages();
            createEventUpload();
            createEventDropAndDrag();
        });
    };



    // Modal
    //////////////////////////////////////////////////
    $(".field-gallery .modal").on("shown.bs.modal", function(e) {
        $(this).removeData('bs.modal');
    });


    // Open gallery
    //////////////////////////////////////////////////
    $('form .field-gallery').each(function(index, el){
        var galery = $(el);
        var modal = $('.modal', el);

        $('.field-gallery .btn-open-gallery-images').on('click', function(){
           modal.modal('show');
        });

        galery.galery();
    });

}( jQuery ));
