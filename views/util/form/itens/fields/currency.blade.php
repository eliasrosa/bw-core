<div class="col-lg-{{ $item->width or '12' }}">
    <label>{{ $item->label }}</label>
    <div class="form-group input-group @if ($errors->has($item->name)) has-error @endif">
        @if($item->static)
            <div class="form-control-static">{{ $item->getValue() }}</div>
        @else
            <span class="input-group-addon">{{ $item->symbol }}</span>
            <input type="text" name="{{ $item->name }}" value="{{ $item->getValue() }}" {!! $item->buildAttributes() !!}>
        @endif
        <div class="help-block">{{ $item->help_block }}</div>
    </div>
</div>
