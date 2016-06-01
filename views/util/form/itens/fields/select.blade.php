@extends('BW::util.form.itens.fields.field')

@section('field')
    <select name="{{ $item->name }}" {!! $item->buildAttributes() !!}>
        @foreach($item->getOptions() as $key => $value)
            <option value="{{ $key }}" {{ $item->getValue() == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
@overwrite
