
@component('mail::message')

<h1 style="font-size:18px; text-align:center">
  Bienvenido/a {{$user->nombre}}!
</h1>
<p style="text-align:center">
  Tu acceso a al gestor de reservas de ISEF fue concedido!
</p>
@component('mail::button', ['url' => $url, 'color' => 'success'])
  Ingresar
@endcomponent

@endcomponent