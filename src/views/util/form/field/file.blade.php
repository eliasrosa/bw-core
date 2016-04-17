@extends('BW::util.form.field')

@section('field')
    <input name="{{ $name }}" type="{{ $type }}" {!! $attributes_html !!}>
@overwrite
