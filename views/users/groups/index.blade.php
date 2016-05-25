@extends('BW::template.index')

@section('title', '<span class="fa fa-users"></span> Grupos de usuários')

@section('title_buttons')
    <a href="{{ route('bw.users.groups.create') }}"><span class="fa fa-plus"></span> Adicionar grupo</a>
@endsection

