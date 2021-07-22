@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT<br>
<div style="font-size: small">Usted realizó una nueva solicitud de prácticas</div>
@component('mail::panel')
<h2>Datos</h2>
<b>Estudiante: </b> {{$informacion['usuario']['lastname']}} {{ $informacion['usuario']['name'] }}<br>
<b>Correo Institucional: </b> {{$informacion['usuario']['email']}}<br>
<b>Empresa: </b> {{$informacion['compania']['name']}}<br>
<b>Jefe inmediato: </b> {{$informacion['representante']['lastname']}} {{$informacion['representante']['lastname']}}<br>
<b>Fecha inicio: </b> {{date('d-m-yy',strtotime($informacion['datosSolicitud']['start_date']))}}<br>
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent
