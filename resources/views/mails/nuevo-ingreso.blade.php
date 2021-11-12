
@component('mail::message')

<h1 style="font-size:18px;">
  Un nuevo usuario se registró en el sistema
</h1>
@component('mail::panel')
<ul>
  <li><b>Nombre:</b> {{$user->nombre}} {{$user->apellido}}</li>
  <li><b>Cédula:</b> {{ $user->ci }}</li>
  <li><b>Correo:</b> {{$user->correo}}</li>
  <li><b>Teléfono:</b> {{$user->telefono}}</li>
  <li><b>Departamento:</b> {{$user->departamento->nombre}}</li>
  <li><b>Fecha de registro:</b> {{$user->created_at}}</li>
</ul>
@endcomponent
<p style="text-align: center">
  Para dar acceso o rechazar a este usuario debe ingresar al sistema.
</p>
@component('mail::button', ['url' => $url, 'color' => 'success'])
  Ingresar
@endcomponent

@endcomponent