@component('mail::message')
# Bienvenido a Prácticas Pre Profesionales de la ESFOT<br>Se creo un usuario con las siguiente información:
@component('mail::panel')
<h3>Información:</h3>
<b>Usuario: </b> {{ $user['email'] }}<br>
<b>Password: </b> {{ $user['password'] }}<br>
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent
