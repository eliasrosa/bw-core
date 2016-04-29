@extends('BW::util.form.itens.fields.field')

@section('field')
    <input type="file" name="{{ $item->name }}" {!! $item->buildAttributes() !!}>
@overwrite
