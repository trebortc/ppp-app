@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT<br>
@switch($informacion['representante']['sex'])
@case('female')
<div style="font-size: small">Estimada {{$informacion['representante']['lastname']}} {{$informacion['representante']['name']}}, se asignado un profesor tutor al estudiante<br></div>
@break
@case('male')
<div style="font-size: small">Estimado {{$informacion['representante']['lastname']}} {{$informacion['representante']['name']}}, se asignado un profesor tutor al estudiante<br></div>
@break
@endswitch
@component('mail::panel')
<h2>Información</h2>
<b>Estudiante: </b>{{$informacion['estudiante']['lastname']}} {{$informacion['estudiante']['name']}}<br>
<b>Correo Institucional: </b>{{$informacion['estudiante']['email']}}<br>
<b>Profesor - Tutor: </b>{{$informacion['profesor']['lastname']}} {{$informacion['representante']['name']}}<br>
<b>Correo Institucional: </b>{{$informacion['profesor']['email']}}<br>
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent
