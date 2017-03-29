<div class="groups col-lg-12" {!! $item->buildAttributes() !!}>
    <div class="panel panel-{{ $item->type or 'default' }}">
        @if(!is_null($item->title))
            <div class="panel-heading">
                <h3 class="panel-title">{{ $item->title }}</h3>
            </div>
        @endif
        <div class="panel-body">
            @include('BW::util.form.itens', ['item' => $item])
        </div>
    </div>
</div>
