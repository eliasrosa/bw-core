@extends('BW::template.index')

@section('header.icon', 'glyphicon glyphicon-home')
@section('header.title', 'Bem vindo')

@section('style')
    @parent
    <link href="{{ asset('/packages/eliasrosa/bw-core/home/home.css') }}" rel="stylesheet">
@endsection

@section('script')
    @parent
    <script src="{{ asset('/packages/eliasrosa/bw-core/home/home.js') }}" type="text/javascript"></script>
@endsection

@section('content.index')
    <div id="home-container"></div>
@endsection
