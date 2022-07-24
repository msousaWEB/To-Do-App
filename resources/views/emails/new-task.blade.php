@component('mail::message')
# {{$task}}

Data estimada de conclusão: {{$date_limit}}

@component('mail::button', ['url' => $url])
Ver Tarefa
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
