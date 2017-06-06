<div class="col-lg-{{ $item->width or '12' }}">
    <div class="form-group textarea-group @if ($errors->has($item->name)) has-error @endif">
        <label>{{ $item->label }}</label>
        @if($item->static)
            <div class="form-control-static">{{ $item->getValue() }}</div>
        @else
		    <textarea name="{{ $item->name }}" {!! $item->buildAttributes() !!}>{{ $item->getValue() }}</textarea>
        	<input type="hidden" name="{{ $item->name }}_type" value="{{ $item->getEditorType() }}">
	        <span style="font-size: 11px;">Selecione o editor: 
	        	<a href="#" data-editor="simple-text">Texto simples</a> | 
	       		<a href="#" data-editor="html">HTML</a> | 
	        	<a href="#" data-editor="markdown">Markdown</a>
	        </span>
        @endif
        <div class="help-block">{{ $item->help_block }}</div>
    </div>
</div>
