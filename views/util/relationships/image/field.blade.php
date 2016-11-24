@extends('BW::util.form.itens.fields.field')

@section('field')
    <div data-relation-ref-id="{{ $item->getRefId() }}"
         data-relation-id="{{ $item->relation['id'] }}"
         data-url-site="{{ asset('/images') }}"
         data-url-base="{{ route('bw.relationships.image.get', [$item->relation['id'], $item->getRefId()]) }}"
         class="field-image clearfix">
    </div>
@overwrite
