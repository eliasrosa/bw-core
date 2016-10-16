@if(isset($breadcrumb))
    <ul class="breadcrumb">
        @foreach($breadcrumb as $b)
            @if($b['href'])
                <li><a href="{{ $b['href'] }}">{{ $b['title'] }}</a></li>
            @else
                <li class="active">{{ $b['title'] }}</li>
            @endif
        @endforeach
    </ul>
@endif
