@component('mail::message')
# Pagamento efetuado com sucesso

Ola {{$name}}, vimos por esse meio informa-lo que seu pagamento foi realizado com sucesso.

O codigo para o levantamento é {{$code}},
o seu receptor devera levar consigo a sua peça de identidade ou a peça de identidade que
identifique o receptor denominado {{$receptor}}, o dinheiro não sera entrege sem uma peça
de identidade com o mesmo nome.

@component('mail::button', ['url' => ''])
Ver Os Detalhes
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
