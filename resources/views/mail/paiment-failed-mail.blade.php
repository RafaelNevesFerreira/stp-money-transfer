@component('mail::message')
# Falha Ao Pagar em prestações

Pedimos desculpas, não foi possivél concluir a operação pois a sua carta de credito foi recusada.

@component('mail::button', ['url' => env("APP_URL") . "/send"])
Tentar De Novo
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent