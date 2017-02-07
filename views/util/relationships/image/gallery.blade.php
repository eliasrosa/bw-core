@extends('BW::util.form.itens.fields.field')

@section('field')
    <div data-relation-ref-id="{{ $item->getRefId() }}"
         data-relation-id="{{ $item->relation['id'] }}"
         data-url-site="{{ asset('/images') }}"
         data-url-base="{{ route('bw.relationships.image.gallery.get', [$item->relation['id'], $item->getRefId()]) }}"
         class="field-gallery clearfix">

        <input type="file" accept="image/jpeg, image/png, image/bmp" multiple>

        <div class="images">
            <div class="image fa fa-image"></div>
            <div class="image fa fa-image"></div>
            <div class="image fa fa-image"></div>
            <div class="image fa fa-image"></div>
            <div class="image fa fa-image"></div>
            <div class="image fa fa-image"></div>
            <div class="image fa fa-image"></div>
        </div>
    </div>
@overwrite
