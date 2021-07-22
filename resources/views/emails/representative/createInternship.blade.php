@component('mail::message')
# Bienvenido al Sistema de Prácticas Pre Profesionales de la ESFOT<br>
@switch($informacion['representante']['sex'])
@case('female')
<div style="font-size: small">Estimada {{$informacion['representante']['lastname']}} {{$informacion['representante']['name']}},<br></div>
@break
@case('male')
<div style="font-size: small">Estimado {{$informacion['representante']['lastname']}} {{$informacion['representante']['name']}},<br></div>
@break
@endswitch
<div style="font-size: small">Usted ha sido registrado en el sistema, a través de una solicitud de Prácticas Pre Profesionales</div>
@component('mail::panel')
<b>Pasante: </b> {{ $informacion['usuario']['lastname']}} {{ $informacion['usuario']['name'] }}<br>
<b>Correo Institucional: </b> {{$informacion['usuario']['email']}}<br>
<b>Fecha inicio: </b> {{date('d-m-yy',strtotime($informacion['datosSolicitud']['start_date']))}}<br><br>
<b>Recuerda que puedes ingresar al sistema</b>
@endcomponent
# Gracias,
{{ config('app.name')}} - {{ config('app.sigla') }}
@endcomponent

