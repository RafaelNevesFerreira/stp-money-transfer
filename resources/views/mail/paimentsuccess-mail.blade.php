@component('mail::message')
# Pagamento efetuado com sucesso

Ola {{$name}}, vimos por esse meio informa-lo que seu pagamento foi realizado com sucesso.

O codigo para o levantamento é <b>{{$code}}</b>,
o seu receptor devera ir acompanhado da sua peça de identidade ou da peça de identidade que
identifique o receptor denominado <b>{{$receptor}}</b>, o dinheiro não sera entrege sem uma peça
de identidade com o mesmo nome.

@component('mail::button', ['url' => ''])
Ver Os Detalhes
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
