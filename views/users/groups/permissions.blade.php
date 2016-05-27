<div id="permissions">
    @foreach ($item->params as $permission)
        <div class="checkbox col-lg-6">
            <input name="permissions[]" value="{{ $permission['value'] }}" {{ $permission['checked'] }} type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Permitir" data-off="Negar">
            <label>{{ $permission['label'] }}</label>
        </div>
    @endforeach
</div>

<div id="text_super_admin" class="alert alert-success">
    Usuários deste grupo terão acesso completo ao sistema!
</div>
