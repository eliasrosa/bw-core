{{ \BW\Admin\Helpers\Html::addCSS(asset('/packages/eliasrosa/bw-core/util/form/form.css')) }}
{{ \BW\Admin\Helpers\Html::addJS(asset('/packages/eliasrosa/bw-core/util/form/form.js')) }}

<form role="form"{!! $form->getAttributes() !!}>
    {!! csrf_field() !!}

    @foreach($form->groups as $g)
        <div class="groups col-lg-{{ $g->col }}">
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

    <div class="toolbar-submit col-lg-12">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
