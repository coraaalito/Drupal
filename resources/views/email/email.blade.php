<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>    

    <div style="background-color: rgb(230, 232, 238); padding: 30px; margin: 30px;">
        <img src="https://cadese.cuc.udg.mx/images/logo.png" alt="logo" style="text-align: center">
        <h1 style="justify-content: center; justify-items: center; padding: 5px; text-align: center">Nuevo equipo registrado a Emprende</h1>
        <hr><br>
        <h3><b>Nombre del equipo:</b> {{$data['name']}}</h3>
        <h3>Url del proyecto:  {{$data['url_proyect']??'No hay '}}</h3>
        <h3>Url del video:  {{$data['url_video']??'No hay '}}</h3>
        <hr>
        <h3 style="text-align: center"><b>INTEGRANTES</b></h3>
        <hr>
        @foreach ($data['member'] as $member)
            @if($member['lider']==true)
            <h3 style="text-align: center">LIDER</h3>    
            @endif
            <h3><b>Nombre:</b> {{$member['name']}}</h3>        
            <h3><b>Codigo:</b> {{$member['code']??'--'}}</h3>       
            <h3><b>Correo: </b>{{$member['email']}}</h3>
            <h3><b>Telefono:</b> {{$member['phone']}}</h3>
            <h3><b>Estatus universitario:</b> {{$member['status']}}</h3>
            <hr>
        @endforeach


    </div>
</body>
</html>