@extends('BW::util.form.field')

@section('field')
    <input name="{{ $field->name }}" type="{{ $field->type }}" {!! $field->getAttributes() !!}>
    <input name="{{ $field->name }}_confirmation" type="{{ $field->type }}" class="{{ $field->attributes['class'] }}" style="margin-top: 10px;" placeholder="Repita novamente">
@overwrite
