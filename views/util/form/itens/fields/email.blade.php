@extends('BW::util.form.itens.fields.field')

@section('field')
    <input type="email" name="{{ $item->name }}" value="{{ $item->getValue() }}" {!! $item->buildAttributes() !!}>
@overwrite
