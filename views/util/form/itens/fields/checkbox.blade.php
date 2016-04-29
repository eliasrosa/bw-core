@extends('BW::util.form.itens.fields.field')

@section('field')
    <div class="checkbox">
        <label>
            <input type="checkbox" name="{{ $item->name }}" value="1" {!! $item->buildAttributes() !!}>
        </label>
    </div>
@overwrite
