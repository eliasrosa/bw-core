@extends('BW::util.form.field')

@section('field')
    <input name="{{ $name }}" type="{{ $type }}"  {!! $attributes_html !!}>
    <input name="{{ $name }}_confirmation" type="{{ $type }}" class="{{ $attributes['class'] }}" style="margin-top: 10px;" placeholder="Repita novamente">
@overwrite
