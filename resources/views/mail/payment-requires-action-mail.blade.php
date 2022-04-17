@component('mail::message')
# Seu Cartão Requer Authorização

Boa Tarde {{$name}},  vimos por esse meio informa-lo que seu pagamento não foi efetuado com sucesso pois requer sua autorização.
Pedimos que faça o pagamento clicando no botão a baixo,


@component('mail::button', ['url' => $link])
Pagar
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
