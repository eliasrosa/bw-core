<form role="form" method="">

    @foreach($form->groups as $g)
        <div class="col-lg-{{ $g->col }}">
            <div class="panel panel-{{ $g->class }}">
                @if($g->title)
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $g->title }}</h3>
                    </div>
                @endif
                <div class="panel-body">
                    @foreach($g->fields as $field)
                        @include($field->view, ['field' => $field])
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <div class="col-lg-12">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
