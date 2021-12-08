
@component('mail::message')

<h1 style="font-size:18px;">
  Un usuario quiere reservar por más de 24 horas.
</h1>
@component('mail::panel')
<ul>
  <li><b>Cédula usuario:</b> {{ $reserva->user_ci }}</li>
  <li><b>Fecha Inicio:</b> {{$reserva->inicio}}</li>
  <li><b>Fecha Inicio:</b> {{$reserva->fin}}</li>
  <li><b>Lugar:</b> {{$reserva->deposito}}, {{$reserva->departamento}}</li>
  <li><b>Razón de uso:</b> {{$reserva->razon}}</li>
</ul>
@endcomponent
<p style="text-align: center">
  Es necesario que un administrador acepte o rechace esta reserva.
  Ingrese a la aplicación para ver toda la información.
</p>
@component('mail::button', ['url' => $url, 'color' => 'success'])
  Ver reserva
@endcomponent

@endcomponent