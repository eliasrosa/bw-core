@foreach ($item->params['tags'] as $tag)
    <div class="col-lg-3" style="padding: 0 10px 10px 0;">
       <label> <input name="{{ $item->params['field']['name'] }}[{{ $tag->id }}]"
               value="{{ $tag->id }}" 
               type="checkbox" 
               data-toggle="toggle" 
               data-onstyle="success" 
               data-on="<i class='fa fa-check'></i>" 
               data-off=" "
               data-size="small"
               {{ count($tag->ref) ? ' checked' : '' }}> 

        <label>{{ $tag->name }}</label>
    </div>
@endforeach
