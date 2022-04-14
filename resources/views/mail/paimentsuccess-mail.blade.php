@component('mail::message')
# Pagamento efetuado com sucesso

Ola {{$name}}, vimos por esse meio informalo que seu pagamento foi realizado com sucesso.

@component('mail::button', ['url' => ''])
Ver Od Detalhes
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
