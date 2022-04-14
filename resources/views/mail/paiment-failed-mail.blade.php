@component('mail::message')
# Falha Ao Pagar em prestações

Pedimos desculpas mas não foi possivel concluir a operação pois a sua carta de credito foi recusada.

@component('mail::button', ['url' => ''])
Tente De Novo
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
