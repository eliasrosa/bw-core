@extends('BW::template.layout')

@section('content')

    <h1 class="page-header">@yield('title')</h1>

    @include('BW::util.flash.message')

    <div id="lista-top" class="row">
        <div class="filter col-md-6">
            {!! $filter or '' !!}
        </div>

        <div class="menu col-md-6">
            {!! $menu or '' !!}
        </div>
    </div>

    <hr>

    {!! $grid !!}

@endsection

@section('style')
    <link href="{{ asset('/packages/eliasrosa/bw-core/template/lista.css') }}" rel="stylesheet">
@endsection
