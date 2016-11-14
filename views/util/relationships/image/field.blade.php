@extends('BW::util.form.itens.fields.field')

@section('field')
    <div class="field-image clearfix">
        @if($item->hasImage())
            <div class="image" style="background: #FFF url('{{ $item->getImageUrl('bw-small') }}') no-repeat center center"></div>
            <div class="options">
                <a href="{{ $item->getImageUrl('download') }}" class="btn btn-success btn-xs"><span class="fa fa-download"></span> Download</a>
                <a href="{{ $item->getImageUrl('original') }}" target="_blank" class="btn btn-primary btn-xs"><span class="fa fa-image"></span> Exibir original</a>
                <a href="{{ route('bw.relationships.image.destroy', $item->getId()) }}" class="btn btn-danger btn-remove btn-xs"><span class="fa fa-trash-o"></span> Remover imagem</a>
                <input type="file" name="{{ $item->name }}" {!! $item->buildAttributes() !!}>
            </div>
        @else
            <div class="image fa fa-image"></div>
            <div class="options">
                <input type="file" name="{{ $item->name }}" {!! $item->buildAttributes() !!}>
            </div>
        @endif
    </div>
@overwrite
