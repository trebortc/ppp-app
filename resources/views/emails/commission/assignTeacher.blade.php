@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT<br>
<div style="font-size: small">Se ha asignado un profesor-tutor a un estudiante<br></div>
@component('mail::panel')
<h2>Información</h2>
@switch($informacion['profesor']['sex'])
@case('female')
<b>Tutora: </b> {{ $informacion['profesor']['lastname'] }} {{ $informacion['profesor']['name'] }}<br>
@break
@case('male')
<b>Tutor: </b> {{ $informacion['profesor']['lastname'] }} {{ $informacion['profesor']['name'] }}<br>
@break
@endswitch
<b>Estudiante: </b> {{ $informacion['estudiante']['lastname']}} {{ $informacion['estudiante']['name'] }}<br>
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent
