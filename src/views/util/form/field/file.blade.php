@extends('BW::util.form.field')

@section('field')
    <input name="{{ $field->name }}" type="{{ $field->type }}" {!! $field->getAttributes() !!}>
@overwrite
