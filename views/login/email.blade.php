<h2>Pedido de nova senha</h2>

<p>Olá {{ $name }}, <br />
<br />
recebemos o pedido para a criação de uma nova senha para o email: {{ $email }} <br />
Para isso, clique no link abaixo. Ele vai abrir uma página para a criação da nova senha.<br /><br />

<a href="{{ $url }}">Trocar minha senha</a></p>


<h2>Problemas ao abrir o link?</h2>
<p>Se o link acima não funcionar, copie e cole o link no seu navegador:<br />
<a href="{{ $url }}">{{ $url }}</a></p>

<h2>Observações</h2>
<ul>
    <li>O link enviado expira em {{ config('auth.email.remember.expire') / 60 / 60 }} horas. Após esse prazo, ele não vai funcionar.</li>
</ul>

