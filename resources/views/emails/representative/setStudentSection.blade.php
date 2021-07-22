@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT
@switch($informacion['representante']['sex'])
@case('female')
<div style="font-size: small">Estimada {{$informacion['representante']['lastname']}} {{$informacion['representante']['name']}},<br></div>
@break
@case('male')
<div style="font-size: small">Estimado {{$informacion['representante']['lastname']}} {{$informacion['representante']['name']}},<br></div>
@break
@endswitch
@component('mail::panel')
<h2>Información sobre actividades realizadas por estudiante</h2>
<b>Estudiante: </b> {{ $informacion['estudiante']['lastname']}} {{ $informacion['estudiante']['name'] }}<br>
<b>Fecha finalización: </b> {{date('d-m-yy', strtotime($informacion['practica']['finish_date']))}}<br>
<b>Actividades realizadas: </b>
@forelse ($informacion['actividades'] as $actividad)
<li>{{ $actividad->description }}</li>
@empty
<p>Sin actividades</p>
@endforelse
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent
