@extends('BW::template.index')

@section('title', '<span class="fa fa-users"></span> Usuários')

@section('title_buttons')
    <a href="{{ route('bw.users.create') }}"><span class="fa fa-plus"></span> Adicionar usuário</a>
@endsection

