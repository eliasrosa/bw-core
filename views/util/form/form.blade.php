{{ \BW\Helpers\Html::addCSS(asset('/packages/eliasrosa/bw-core/util/form/form.css')) }}
{{ \BW\Helpers\Html::addJS(asset('/packages/eliasrosa/bw-core/util/form/form.js')) }}

<form role="form"{!! $form->buildAttributes() !!}>
    {!! csrf_field() !!}

     @include('BW::util.form.itens', ['item' => $form])

    <div class="toolbar-submit col-lg-12">
        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Salvar</button>
    </div>
</form>
