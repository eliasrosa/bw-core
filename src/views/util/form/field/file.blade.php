@extends('BW::util.form.field')

@section('field')
    <input type="file" name="{{ $item->name }}" {!! $item->buildAttributes() !!}>
@overwrite
