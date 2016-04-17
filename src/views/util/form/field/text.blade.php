@extends('BW::util.form.field')

@section('field')
     <input name="{{ $name }}" type="{{ $type }}" value="{{ $value }}" {!! $attributes_html !!}>
@overwrite
