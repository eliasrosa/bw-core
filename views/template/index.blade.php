@extends('BW::template.layout')

@section('content')

    <h1 class="page-header">@yield('title') <span class="title_buttons">@yield('title_buttons')</span></h1>

    @include('BW::util.flash.message')

    <div id="lista-top" class="row">
        <div class="filter col-md-12">
            {!! $filter or '' !!}
        </div>
    </div>

    <hr>

    {!! $grid !!}

@endsection

@section('style')
    <link href="{{ asset('/packages/eliasrosa/bw-core/template/index.css') }}" rel="stylesheet">
@endsection
