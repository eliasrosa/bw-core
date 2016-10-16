@extends('BW::template.index')

@section('header.icon', 'fa fa-list')

@section('header.title')
Gerenciar itens do campo: {{ $relation['title'] }}
@endsection

@section('header.menu')
    <li><a href="{{ route('bw.relationships.listing.create', ['relation_id' => $relation['id']]) }}"><span class="fa fa-plus"></span> Adicionar novo</a></li>
@endsection

@section('content.index')

    <div class="table-responsive">
        <table class="datatable-simple">
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Nome</th>
                    <th>Registros relacionados</th>
                    <th>Descrição</th>
                    <th style="width: 150px;">Opçoes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $i)
                <tr>
                    <td>{{ $i->id }}</td>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->ref->count() }}</td>
                    <td>{{ $i->description }}</td>
                    <td>
                        <a href="{{ route('bw.relationships.listing.edit', ['id' => $i->id, 'relation_id' => $relation['id']]) }}" class="btn btn-primary btn-xs">Editar</a>

                        <form action="{{ route('bw.relationships.listing.destroy', $i->id) }}" style="display: inline-block" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="relation_id" value="{{ $relation['id'] }}">
                            <input type="submit" class="btn btn-danger btn-xs" value="Remover">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
