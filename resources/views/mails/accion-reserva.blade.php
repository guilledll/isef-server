
@component('mail::message')

<h1 style="font-size:18px; text-align:center">
  Tu reserva en ISEF fue {{ $estado }}.
</h1>
<p style="text-align:center">
  Puedes ver el estado presionando el siguiente botón.
</p>
@component('mail::button', ['url' => $url, 'color' => 'success'])
  Ver reserva
@endcomponent

@endcomponent