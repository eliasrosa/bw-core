@extends('BW::template.layout')

@section('content')

    <h1 class="page-header"><span class="fa fa-image"></span> Mídias / Imagens <span class="title_buttons">
      <a href="{{ route('bw.media.images.create') }}"><span class="fa fa-plus"></span> Adicionar imagem</a>
    </span></h1>

    @include('BW::util.flash.message')

@endsection

@section('style')
    <link href="{{ asset('/packages/eliasrosa/bw-core/template/index.css') }}" rel="stylesheet">
    <link href="{{ asset('/packages/eliasrosa/bw-core/midias/imagens/index.css') }}" rel="stylesheet">
@endsection
