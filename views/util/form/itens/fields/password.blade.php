@extends('BW::util.form.itens.fields.field')

@section('field')
    <input type="password" name="{{ $item->name }}" {!! $item->buildAttributes() !!}>
    <input type="password" name="{{ $item->name }}_confirmation" class="{{ $item->html_attributes['class'] }}" style="margin-top: 10px;" placeholder="Repita a senha">
@overwrite
