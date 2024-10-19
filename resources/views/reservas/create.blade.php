<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Realizar reserva') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Información del paquete -->
                    <h3 class="text-3xl font-bold mb-4">{{ $paquete->nombre }}</h3>
                    <p class="text-gray-600 font-semibold mb-2"> <strong>{{ __('Destino: ') }}</strong> {{ $paquete->destino->nombre }}</p>
                    <p class="text-gray-600 font-semibold mb-2"> <strong>{{ __('Duración: ') }}</strong> {{ $paquete->duracion . ' días' }}</p>
                    <p class="text-gray-600 font-semibold mb-4"> <strong>{{ __('Precio por persona: ') }}</strong>  {{ "S/. " . $paquete->precio_individual }}</p>

                    <!-- Mostrar mensajes de error de validación -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Hubo algunos problemas con tu reserva:') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Sección de actividades incluidas en el paquete -->
                    <div class="my-6">
                        <h4 class="text-lg font-semibold">{{ __('Actividades incluidas') }}</h4>
                        @if($paquete->actividades->isNotEmpty())
                            <table class="table-auto w-full mt-4">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left">{{ __('Nombre') }}</th>
                                        <th class="px-4 py-2 text-left">{{ __('Horario') }}</th>
                                        <th class="px-4 py-2 text-left">{{ __('Duración') }}</th>
                                        <th class="px-4 py-2 text-left">{{ __('Precio normal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paquete->actividades as $actividad)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $actividad->nombre }}</td>
                                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i') }}</td>
                                            <td class="border px-4 py-2">{{ $actividad->duracion }} {{ __('min') }}</td>
                                            <td class="border px-4 py-2"> {{ __('S/.') }} {{ $actividad->precio }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500">{{ __('Este paquete no incluye actividades.') }}</p>
                        @endif
                    </div>

                    <!-- Formulario para la reserva -->
                    <form action="{{ route('reservas.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="paquete_id" value="{{ $paquete->id }}">

                        <!-- Campo cantidad de personas -->
                        <div class="mb-4">
                            <label for="num_personas" class="block text-sm font-bold text-gray-700">{{ __('Cantidad de personas') }}</label>
                            <input type="number" name="num_personas" id="num_personas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="1" value="{{ old('num_personas', 1) }}" required>
                            @error('num_personas')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de fecha de la reserva -->
                        <div class="mb-4">
                            <label for="fecha_reserva" class="block text-sm font-bold text-gray-700">{{ __('Fecha de la reserva') }}</label>
                            <input type="date" name="fecha_reserva" id="fecha_reserva" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('fecha_reserva') }}" required>
                            @error('fecha_reserva')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Mostrar el precio total en tiempo real usando JavaScript -->
                        <div class="mb-4">
                            <label for="precio_total" class="block text-sm font-bold text-gray-700">{{ __('Precio total') }}</label>
                            <input type="text" id="precio_total" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly value="S/. {{ $paquete->precio_individual }}">
                        </div>

                        <!-- Botón para confirmar la reserva -->
                        <div class="flex justify-end">
                            <a href="{{ route('paquetes.show', $paquete->id) }}" class="bg-gray-600 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 ml-4">
                                {{ __('Confirmar reserva') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Script para calcular el precio total basado en la cantidad de personas
        document.getElementById('num_personas').addEventListener('input', function() {
            const precioPorPersona = {{ $paquete->precio_individual }};
            const cantidadPersonas = this.value;
            const precioTotal = cantidadPersonas * precioPorPersona;
            document.getElementById('precio_total').value = 'S/. ' + precioTotal.toFixed(2);
        });
    </script>
</x-app-layout>
