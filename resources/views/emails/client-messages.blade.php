@component('mail::message')
#to {{$completeclient->email}}
{{$completeclient->password}}
Merci beaucoup pour votre demande
Nous avons vous acceptez pour faire une operation chez nous
for more infromations cliquer sur la bouton :
@component('mail::button', ['url' =>url( 'clien/' . $completeclient->id)])
more information
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
