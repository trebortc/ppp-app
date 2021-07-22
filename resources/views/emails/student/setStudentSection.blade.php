@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT
@component('mail::panel')
<h2>Información</h2>
<b>Estudiante: </b> {{ $informacion['estudiante']['lastname']}} {{ $informacion['estudiante']['name'] }}<br>
<b>Jefe inmediato: </b> {{$informacion['representante']['lastname']}} {{$informacion['representante']['name']}}<br>
<b>Empresa: </b> {{$informacion['compania']}}<br>
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
