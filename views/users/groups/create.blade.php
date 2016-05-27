@extends('BW::template.form')
@section('title', '<span class="fa fa-users"></span> Novo grupo')

@section('style')
    @parent
    <link href="{{ asset('/packages/eliasrosa/bw-core/users/groups/form.css') }}" rel="stylesheet">
@endsection

@section('script')
    @parent
    <script src="{{ asset('/packages/eliasrosa/bw-core/users/groups/form.js') }}"></script>
@endsection
