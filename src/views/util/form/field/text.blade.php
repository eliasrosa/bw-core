@extends('BW::util.form.field')

@section('field')
     <input type="text" name="{{ $item->name }}" value="{{ $item->getValue() }}" {!! $item->buildAttributes() !!}>
@overwrite
