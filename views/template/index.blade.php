@extends('BW::template.layout')

@section('content')

    @include('BW::util.flash.message')

    <div class="page-header">
        <h1><span class="icon @yield('header.icon')"></span>@yield('header.title')</h1>

        @if(View::hasSection('header.menu'))
            <nav class="navbar navbar-default navbar-default-list">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#view-menu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

                <div class="collapse navbar-collapse" id="view-menu">
                    <ul class="nav navbar-nav navbar-right">
                        @yield('header.menu', '')

                        @include('BW::util.relationships.menu')

                    </ul>
                </div>

            </nav>
        @endif
    </div>

    @yield('content.index')
@endsection
