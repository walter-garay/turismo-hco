<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis itinerarios') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($itinerarios as $itinerario)
                <div class="bg-white shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Título del itinerario y botón Exportar a PDF -->
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-base font-bold text-green-600">{{ $itinerario->nombre }}</h3>
                            <button class="bg-gray-200 text-gray-700 font-semibold py-1 px-3 rounded hover:bg-gray-300">
                                {{ __('Exportar a PDF') }}
                            </button>
                        </div>

                        @if($itinerario->actividades->isNotEmpty())
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-gray-400 font-semibold">{{ __('Actividad') }}</th>
                                        <th class="px-4 py-2 text-left text-gray-400 font-semibold">{{ __('Disponibilidad') }}</th>
                                        <th class="px-4 py-2 text-left text-gray-400 font-semibold">{{ __('Duración') }}</th>
                                        <th class="px-4 py-2 text-left text-gray-400 font-semibold">{{ __('Precio') }}</th>
                                        <th class="px-4 py-2 text-left font-semibold">{{ __('Mi programación') }}</th>
                                        <th class="px-4 py-2 text-center font-semibold">{{ __('Acciones') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itinerario->actividades as $actividad)
                                        <tr>
                                            <!-- Columna "nombre" con estilo gris claro -->
                                            <td class="border px-4 py-2 text-gray-400">
                                                {{ $actividad->nombre }}
                                                @if ($actividad->tipo === 'evento')
                                                    ({{ __('evento') }})
                                                @endif
                                            </td>

                                            <!-- Columna "Disponibilidad", que depende del tipo -->
                                            <td class="border px-4 py-2 text-gray-400">
                                                @if ($actividad->tipo === 'evento')
                                                    <div class="flex flex-col">
                                                        <!-- Mostrar fecha del evento -->
                                                        <span>{{ \Carbon\Carbon::parse($actividad->fecha_evento)->format('d/m/Y') }}</span>

                                                        <!-- Mostrar horario del evento -->
                                                        <span>{{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i') }}</span>
                                                    </div>
                                                @else
                                                    <!-- Mostrar solo horario si no es evento -->
                                                    {{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i') }}
                                                @endif
                                            </td>

                                            <!-- Columna "duración" con estilo gris claro -->
                                            <td class="border px-4 py-2 text-gray-400">{{ $actividad->duracion }} {{ __('min') }}</td>

                                            <!-- Columna "precio" con estilo gris claro -->
                                            <td class="border px-4 py-2 text-gray-400">{{ __('S/.') }} {{ $actividad->precio }}</td>

                                            <!-- Columna "Mi programación" (propia de itinerario_actividad) -->
                                            <td class="border px-4 py-2">
                                                <div class="flex flex-col">
                                                    <!-- Mostrar fecha -->
                                                    <div>{{ $actividad->pivot->fecha ? \Carbon\Carbon::parse($actividad->pivot->fecha)->format('d/m/Y') : __('Fecha no definida') }}</div>

                                                    <!-- Mostrar hora inicio y fin -->
                                                    @if ($actividad->pivot->hora_inicio && $actividad->pivot->hora_fin)
                                                        <div>{{ \Carbon\Carbon::parse($actividad->pivot->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividad->pivot->hora_fin)->format('H:i') }}</div>
                                                    @else
                                                        <div>{{ __('Horario no definido') }}</div>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="border px-4 py-4 flex justify-center space-x-2">
                                                <!-- Botón Editar -->
                                                <a href="{{ route('itinerarios.editActividad', ['itinerario' => $itinerario->id, 'actividad' => $actividad->id]) }}"
                                                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg text-xs hover:bg-blue-700 flex items-center space-x-1">
                                                    <span>{{ __('Programar') }}</span>
                                                </a>

                                                <!-- Formulario para quitar actividad -->
                                                <form action="{{ route('itinerarios.quitarActividad', ['destino' => $itinerario->destino_id, 'actividad' => $actividad->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-gray-600 text-white font-bold py-2 px-4 rounded-lg text-xs hover:bg-gray-700">
                                                        {{ __('Quitar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500">{{ __('No hay actividades registradas en este itinerario.') }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500">{{ __('No tienes itinerarios creados.') }}</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
