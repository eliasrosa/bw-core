<div class="form-group">
    <label>{{ $label }}</label>
    @if($is_static)
        <div class="form-control-static">{{ $value }}</div>
    @else
        @yield('field')
    @endif
    <div class="help-block">{{ $help_block }}</div>
</div>

