<div class="form-group">
    <label>{{ $field->label }}</label>
    @if($field->static)
        <div class="form-control-static">{{ $field->getValue() }}</div>
    @else
        @yield('field')
    @endif
    <div class="help-block">{{ $field->help_block }}</div>
</div>
