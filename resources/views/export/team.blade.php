
<tr></tr>
<tr></tr>
<h4>Reporte de equipos registrados</h4>
<h4>Convocatoria: {{$call->title}}</h4>
<h4>Fecha de reporte:{{  date('d-m-Y') }}</h4>
<tr></tr>
<tr></tr>

@foreach ($teams as $team)

<table style="border: 1px solid black; border-collapse: collapse">
    <thead >
        <tr>
            <th align="center" colspan="3" style="border: 1px solid black; background-color: darkslateblue; color:white"><b>Equipo  {{$team->name}} </b></th>
            <th colspan="2" style="border: 1px solid black; background-color: steelblue; color: white;"><b>Integrantes: {{$team->member->count()}}</b></th>
        </tr>
        <tr >
            <th style="border: 1px solid black; " ><b>Nombre</b></th>
            <th style="border: 1px solid black; "><b>Codigo</b></th>
            <th style="border: 1px solid black; "><b>Estatus universitario</b></th>
            <th style="border: 1px solid black; "><b>correo</b></th>
            <th style="border: 1px solid black; "><b>telefono</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($team->member as $member)
        <tr style="border: 1px solid black">
            @if($member->lider)
              <td style="border: 1px solid black; background-color: beige"><b>{{$member->name}}</b></td>
            @else
              <td style="border: 1px solid black;">{{$member->name}}</td>
            @endif            
            <td style="border: 1px solid black;">{{$member->code??'--'}}</td>
            <td style="border: 1px solid black;">{{$member->status}}</td>
            <td style="border: 1px solid black;">{{$member->email}}</td>
            <td style="border: 1px solid black;">{{$member->phone}}</td>
        <tr>
        @endforeach 
    </tbody>
  </table>
@endforeach

