@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT<br>
@switch($informacion['profesor']['sex'])
@case('female')
<div style="font-size: small">Estimada profesora, se le ha asignado un estudiante para tutorias<br></div>
@break
@case('male')
<div style="font-size: small">Estimado profesor, se le ha asignado un estudiante para tutorias<br></div>
@break
@endswitch
@component('mail::panel')
<h2>Información</h2>
<b>Estudiante: </b> {{ $informacion['estudiante']['lastname'] }} {{ $informacion['estudiante']['name'] }}<br>
<b>Correo Institucional: </b> {{ $informacion['estudiante']['email'] }}
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent
