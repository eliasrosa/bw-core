@extends('BW::util.form.itens.fields.field')

@section('field')
    <textarea name="{{ $item->name }}" {!! $item->buildAttributes() !!}>{{ $item->getValue() }}</textarea>
@overwrite
