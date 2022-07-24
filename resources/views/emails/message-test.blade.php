@component('mail::message')
# Introdução

Corpo da mensagem

@component('mail::button', ['url' => ''])
Botão
@endcomponent

Vlw,<br>
{{ config('app.name') }}
@endcomponent
