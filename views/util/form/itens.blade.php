@if(isset($item->itens) && count($item->itens) > 0)
    @foreach($item->itens as $item_filho)
        @include($item_filho->getView(), ['item' => $item_filho])
    @endforeach
@endif
