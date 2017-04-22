@extends('BW::util.form.itens.fields.field')

@section('field')
    <div data-relation-ref-id="{{ $item->getRefId() }}"
         data-relation-id="{{ $item->relation['id'] }}"
         data-url-asset="{{ asset('/images') }}"
         data-url-image="{{ route('bw.relationships.image.get') }}"
         data-url-remove="{{ route('bw.relationships.image.remove') }}"
         data-url-upload="{{ route('bw.relationships.image.upload') }}"
         class="field-image clearfix">
    </div>
@overwrite
