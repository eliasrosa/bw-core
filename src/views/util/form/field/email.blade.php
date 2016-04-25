@extends('BW::util.form.field')

@section('field')
    <input type="email" name="{{ $item->name }}" value="{{ $item->getValue() }}" {!! $item->buildAttributes() !!}>
@overwrite
