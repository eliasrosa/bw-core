@extends('BW::template.layout')

@section('content')

    @include('BW::util.flash.message')

    <div class="page-header">
        <h1>@yield('title')</h1>

        @include('BW::util.form.form')
    </div>

@endsection
