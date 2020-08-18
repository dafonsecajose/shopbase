<h1>Olá, {{$user->name}}, tudo bem? Espero que sim!</h1>
<h3>Obrigado po sua inscrição</h3>

<p>
    Faça bom proveito e excelentes compras em nossa loja!<br>
    Seu e-mail de cadastro é: <strong>{{$user->email}}</strong><br>
    Seu senha: <strong>Por questão de segurança não enviamos sua senha, mas você deve se lembrar!</strong>
</p>
<hr>
Email enviado em {{date('d/m/Y H:i:s')}}.
