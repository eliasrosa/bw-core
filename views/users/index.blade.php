@extends('BW::template.index')

@section('header.icon', 'fa fa-user')
@section('header.title', 'Usuários')

@section('header.menu')
    <li><a href="{{ route('bw.users.create') }}">Adicionar usuário</a></li>
@endsection

@section('content.index')

    <div class="table-responsive">
        <table class="datatable-simple">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Grupo</th>
                    <th>Status</th>
                    <th>Opçoes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $i)
                <tr>
                    <td>{{ $i->id }}</td>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->email }}</td>
                    <td>{{ $i->group->name }}</td>
                    <td><span class="label label-{{ $i->status ? 'success' : 'danger'}}">{{ $i->status ? 'Ativado' : 'Destivado'}}</span></td>
                    <td>
                        <a href="{{ route('bw.users.edit', $i->id) }}" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span> Editar</a>

                        <form action="{{ route('bw.users.destroy', $i->id) }}" style="display: inline-block" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-xs btn-remove-record">
                                <span class="fa fa-trash-o"></span> Remover
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
