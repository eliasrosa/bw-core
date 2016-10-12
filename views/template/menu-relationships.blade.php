
@if(isset($relations_menu))
    @foreach($relations_menu as $menu)
        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="{{ $menu->icon }}"></span> {{ $menu->title }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                @foreach($menu->itens as $link)
                    <li><a href="{{ $link->href }}">{{ $link->title }}</a></li>
                @endforeach
            </ul>
        </li>
    @endforeach
@endif
