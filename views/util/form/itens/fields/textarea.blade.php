<div class="col-lg-{{ $item->width or '12' }}">
    <div class="form-group @if ($errors->has($item->name)) has-error @endif">
        <label>{{ $item->label }}</label>
        @if($item->static)
            <div class="form-control-static">{{ $item->getValue() }}</div>
        @else
		    <textarea name="{{ $item->name }}" {!! $item->buildAttributes() !!}>{{ $item->getValue() }}</textarea>
        @endif
        <div class="help-block">{{ $item->help_block }}</div>
    </div>
</div>
