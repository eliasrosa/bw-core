@foreach($links as $link)
    <a class="{!! is_null($link['class']) ? 'btn btn-success' : $link['class'] !!}" href="{{ route($link['route']) }}">{{ $link['titulo'] }}</a>
@endforeach
