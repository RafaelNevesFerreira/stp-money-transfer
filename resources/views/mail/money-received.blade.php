@component('mail::message')
# Dinheiro Recebido

Ola {{ $user->name }}, Temos o prazer de o informar que
o seu dinheiro foi levantado com sucesso
no dia {{ date('d/m/Y') }}.
Agradecemos pela confiança.


<small><small>
Caso o seu receptor não o informou que ja recebeu o dinheiro
, entre em contato com o nosso suporte o mais rapido
possivel</small></small>

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
