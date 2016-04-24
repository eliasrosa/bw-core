<div class="form-group @if ($errors->has($field->name)) has-error @endif">
    <label>{{ $field->label }}</label>
    @if($field->static)
        <div class="form-control-static">{{ $field->getValue() }}</div>
    @else
        @yield('field')
    @endif
    <div class="help-block">{{ $field->help_block }}</div>
</div>
