@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT<br>
<div style="font-size: small">Estimado estudiante se le asignó un tutor</div>
@component('mail::panel')
<h3>Información</h3>
@switch($informacion['profesor']['sex'])
@case('female')
<b>Tutor: </b> {{$informacion['profesor']['lastname']}} {{$informacion['profesor']['name']}},<br>
@break
@case('male')
<b>Tutora: </b>{{$informacion['profesor']['lastname']}} {{$informacion['profesor']['name']}},<br>
@break
@endswitch
<b>Correo institucional: </b> {{ $informacion['profesor']['email'] }}
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent
