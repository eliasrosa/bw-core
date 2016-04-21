@extends('BW::util.form.field')

@section('field')
     <input name="{{ $field->name }}" type="{{ $field->type }}" value="{{ $field->getValue() }}" {!! $field->getAttributes() !!}>
@overwrite
