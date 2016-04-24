@extends('BW::util.form.field')

@section('field')
    <div class="checkbox">
        <label>
            <input name="{{ $field->name }}" {!! $field->getAttributes() !!}>
        </label>
    </div>
@overwrite
