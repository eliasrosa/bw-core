@extends('BW::template.layout')

@section('content')

    <h1 class="page-header">@yield('title')</h1>

    @include('BW::util.flash.message')

    @include('BW::util.form.form')

@endsection
