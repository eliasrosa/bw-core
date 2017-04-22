<div class="col-lg-{{ $item->width or '12' }}">
    <div class="form-group @if ($errors->has($item->name)) has-error @endif">
        <div data-relation-ref-id="{{ $item->getRefId() }}"
             data-relation-id="{{ $item->relation['id'] }}"
             data-url-images="{{ asset('/images') }}"
             data-url-gallery="{{ route('bw.relationships.image.gallery') }}"
             data-url-remove="{{ route('bw.relationships.image.gallery.remove') }}"
             data-url-reorder="{{ route('bw.relationships.image.gallery.reorder') }}"
             data-url-upload="{{ route('bw.relationships.image.gallery.upload') }}"
             class="field-gallery clearfix">

            <span class="btn btn-success btn-open-gallery-images">Abrir {{ $item->label }}</span>

            <div class="modal fade" id="modal-galeria-imagens" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h4 class="title">{{ $item->label }}</h4>
                        </div>

                        <div class="modal-body">
                            <div class="loading">
                                <span class="fa fa-circle-o-notch fa-spin"></span>
                                Carregando...
                            </div>
                            <div class="empty">Nenhuma imagem encontrada!</div>
                        </div>

                        <div class="modal-footer">

                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Anexar imagens...</span>
                                <input type="file" name="imagem" multiple>
                            </span>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
