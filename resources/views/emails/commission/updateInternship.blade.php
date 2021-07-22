@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT
@component('mail::panel')
<h2>Información</h2>
<b>Estudiante: </b> {{ $informacion['usuario']['lastname']}} {{ $informacion['usuario']['name'] }}<br>
<b>Correo Institucional: </b> {{$informacion['usuario']['email']}}<br>
<b>Empresa: </b> {{$informacion['compania']['name']}}<br>
<b>Jefe inmediato: </b> {{$informacion['representante']['lastname']}} {{$informacion['representante']['name']}}<br>
<b>Fecha inicio: </b> {{date('d-m-yy',strtotime($informacion['datosSolicitud']['start_date']))}}<br>
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent
