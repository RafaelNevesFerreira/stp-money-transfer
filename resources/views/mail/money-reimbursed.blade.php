@component('mail::message')
# Dinheiro Reembolsado

Ola {{ $user->name }},o seu pedido de reembolso esta sendo processado ,
e estarà disponivel num intervalo de 24h.


<small><small>
Caso não informou que deseja um reembolso
, entre em contato com o nosso suporte o mais rapido
possivel</small></small>

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
