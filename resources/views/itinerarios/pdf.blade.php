<!DOCTYPE html>
<html>
<head>
    <title>{{ $itinerario->nombre }}</title>
    <style>
        /* Estilos personalizados para el PDF */
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>{{ $itinerario->nombre }}</h1>

    <table>
        <thead>
            <tr>
                <th>Actividad</th>
                <th>Disponibilidad</th>
                <th>Duración</th>
                <th>Precio</th>
                <th>Mi Programación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($itinerario->actividades as $actividad)
                <tr>
                    <td>{{ $actividad->nombre }}</td>
                    <td>
                        @if ($actividad->tipo === 'evento')
                            {{ \Carbon\Carbon::parse($actividad->fecha_evento)->format('d/m/Y') }}<br>
                            {{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i') }}
                        @else
                            {{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i') }}
                        @endif
                    </td>
                    <td>{{ $actividad->duracion }} min</td>
                    <td>S/. {{ $actividad->precio }}</td>
                    <td>
                        {{ $actividad->pivot->fecha ? \Carbon\Carbon::parse($actividad->pivot->fecha)->format('d/m/Y') : 'Fecha no definida' }}<br>
                        {{ $actividad->pivot->hora_inicio && $actividad->pivot->hora_fin ? \Carbon\Carbon::parse($actividad->pivot->hora_inicio)->format('H:i') . ' - ' . \Carbon\Carbon::parse($actividad->pivot->hora_fin)->format('H:i') : 'Horario no definido' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
