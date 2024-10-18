<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Programar actividad') }}
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">


                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Botón Volver a la lista de itinerarios -->
                    <div class="mb-4">
                        <a href="{{ route('itinerarios.index') }}" class="text-blue-600 font-bold py-2 px-2 rounded hover:bg-blue-100 text-left">
                            {{ __('← Volver a la lista de itinerarios') }}
                        </a>
                    </div>

                    <!-- Título de la actividad -->
                    <h3 class="text-xl font-bold mb-4">{{ $actividad->nombre }}</h3>

                    <!-- Mostrar errores de validación -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Hay algunos problemas con los datos ingresados.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario de edición -->
                    <form action="{{ route('itinerarios.actualizarActividad', ['itinerario' => $itinerario->id, 'actividad' => $actividad->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Campo Fecha -->
                        <div class="mb-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700">{{ __('Fecha') }}</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $actividad->pivot->fecha) }}" class="block w-full mt-1">
                        </div>

                        <!-- Campo Hora de Inicio -->
                        <div class="mb-4">
                            <label for="hora_inicio" class="block text-sm font-medium text-gray-700">{{ __('Hora de Inicio') }}</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio', $actividad->pivot->hora_inicio) }}" class="block w-full mt-1">
                        </div>

                        <!-- Campo Hora de Fin -->
                        <div class="mb-4">
                            <label for="hora_fin" class="block text-sm font-medium text-gray-700">{{ __('Hora de Fin (debe ser mayor a la hora de inicio)') }}</label>
                            <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin', $actividad->pivot->hora_fin) }}" class="block w-full mt-1">
                        </div>

                        <!-- Botón Guardar cambios -->
                        <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700">
                            {{ __('Guardar cambios') }}
                        </button>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
