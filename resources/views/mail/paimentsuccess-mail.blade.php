@component('mail::message')
# Pagamento efetuado com sucesso

Ola {{$name}}, vimos por esse meio informa-lo que seu pagamento foi realizado com sucesso.

@component('mail::button', ['url' => ''])
Ver Os Detalhes
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
