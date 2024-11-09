<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Actividad: ') . $actividad->nombre }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.actividades.update', $actividad->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre y Tipo (en la misma fila) -->
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="col-span-2">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">{{ __('Nombre de la actividad') }}</label>
                                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nombre', $actividad->nombre) }}" required>
                                @error('nombre')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="tipo" class="block text-sm font-medium text-gray-700">{{ __('Tipo') }}</label>
                                <select name="tipo" id="tipo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="actividad" {{ old('tipo', $actividad->tipo) == 'actividad' ? 'selected' : '' }}>Actividad</option>
                                    <option value="evento" {{ old('tipo', $actividad->tipo) == 'evento' ? 'selected' : '' }}>Evento</option>
                                </select>
                                @error('tipo')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Precio y Categoría (en la misma fila) -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="precio" class="block text-sm font-medium text-gray-700">{{ __('Precio') }}</label>
                                <input type="number" step="0.01" name="precio" id="precio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('precio', $actividad->precio) }}" required>
                                @error('precio')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="categoria" class="block text-sm font-medium text-gray-700">{{ __('Categoría') }}</label>
                                <input type="text" name="categoria" id="categoria" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('categoria', $actividad->categoria) }}">
                                @error('categoria')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Fecha del Evento y Horario (en la misma fila) -->
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div>
                                <label for="fecha_evento" class="block text-sm font-medium text-gray-700">{{ __('Fecha del Evento') }}</label>
                                <input type="date" name="fecha_evento" id="fecha_evento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('fecha_evento', $actividad->fecha_evento) }}">
                                @error('fecha_evento')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="hora_inicio" class="block text-sm font-medium text-gray-700">{{ __('Hora de Inicio') }}</label>
                                <input type="time" name="hora_inicio" id="hora_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('hora_inicio', $actividad->hora_inicio) }}">
                                @error('hora_inicio')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="hora_fin" class="block text-sm font-medium text-gray-700">{{ __('Hora de Fin') }}</label>
                                <input type="time" name="hora_fin" id="hora_fin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('hora_fin', $actividad->hora_fin) }}">
                                @error('hora_fin')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Destino -->
                        <div class="mb-4">
                            <label for="destino_id" class="block text-sm font-medium text-gray-700">{{ __('Destino') }}</label>
                            <select name="destino_id" id="destino_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($destinos as $destino)
                                    <option value="{{ $destino->id }}" {{ old('destino_id', $actividad->destino_id) == $destino->id ? 'selected' : '' }}>{{ $destino->nombre }}</option>
                                @endforeach
                            </select>
                            @error('destino_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end">
                            <a href="{{ route('admin.actividades.index') }}" class="bg-gray-600 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 ml-4">
                                {{ __('Guardar cambios') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
