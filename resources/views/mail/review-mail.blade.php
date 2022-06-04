@component('mail::message')
Deixe um Review

Ola, o seu dinheiro foi recebido com sucesso, logo deve estar satisfeito com o nosso serviço, deixe-nos um
comentário sobre como foi a sua experiência e participe no nosso sorteio, caso ganhe, recebera 50€ para enviar à alguém em São Tomé.
para faze-lo, clique no botão à baixo.
@component('mail::button', ['url' => env("APP_URL"). "/review"])
Deixar comentario
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
