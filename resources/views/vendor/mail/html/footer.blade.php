<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<br>
<a href="https://esfot.epn.edu.ec/"><img src="{{env('APP_URL').'/images/icons/casa.svg'}}" title="Página ESFOT" class="logo" alt="ESFOT y Buho Logo"></a>
<a href="https://www.facebook.com/ESFOT-EPN-UIO-163137570522102/?fref=ts"><img src="{{env('APP_URL').'/images/icons/facebook.svg'}}" title="Facebook ESFOT" class="logo" alt="ESFOT y Buho Logo"></a>
<a href="https://esfot.epn.edu.ec/index.php/contactanos"><img src="{{env('APP_URL').'/images/icons/correo-electronico.svg'}}" title="Escribe a la ESFOT" class="logo" alt="ESFOT y Buho Logo"></a>
</td>
</tr>
 <tr>
<td class="content-cell" align="center">
{{ Illuminate\Mail\Markdown::parse($slot) }}<br>
</td>
</tr>
</table>
</td>
</tr>
