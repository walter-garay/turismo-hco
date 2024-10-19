<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nuevo paquete turístico') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Formulario para crear paquete turístico -->
                    <form action="{{ route('admin.paquetes.store') }}" method="POST">
                        @csrf

                        <!-- Nombre y Precio (en la misma fila) -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700">{{ __('Nombre del paquete') }}</label>
                                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="precio_individual" class="block text-sm font-medium text-gray-700">{{ __('Precio por persona') }}</label>
                                <input type="number" name="precio_individual" id="precio_individual" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('precio_individual') }}" required>
                                @error('precio_individual')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Duración y Destino (en la misma fila) -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="duracion" class="block text-sm font-medium text-gray-700">{{ __('Duración (días)') }}</label>
                                <input type="number" name="duracion" id="duracion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('duracion') }}" required>
                                @error('duracion')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="destino_id" class="block text-sm font-medium text-gray-700">{{ __('Destino') }}</label>
                                <select name="destino_id" id="destino_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">{{ __('Seleccionar destino') }}</option>
                                    @foreach($destinos as $destino)
                                        <option value="{{ $destino->id }}">{{ $destino->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('destino_id')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">{{ __('Descripción del paquete') }}</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Actividades (checkboxes) -->
                        <div class="mb-4">
                            <label for="actividades" class="block text-sm font-medium text-gray-700">{{ __('Actividades incluidas en el paquete') }}</label>

                            @error('actividades')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                            
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($destinos as $destino)
                                    <!-- Verificar si el destino tiene actividades -->
                                    @if($destino->actividades->isNotEmpty())
                                        <!-- Subtítulo del destino con texto más pequeño -->
                                        <div class="col-span-2 mt-4">
                                            <h3 class="font-semibold text-gray-600 text-sm">{{ $destino->nombre }}</h3>
                                            <hr class="my-2">
                                        </div>

                                        @foreach($destino->actividades as $actividad)
                                            <div class="flex items-start">
                                                <input type="checkbox" name="actividades[]" value="{{ $actividad->id }}" id="actividad-{{ $actividad->id }}" class="mt-1">
                                                <label for="actividad-{{ $actividad->id }}" class="ml-2 text-sm text-gray-700">{{ $actividad->nombre }} ({{ $actividad->tipo }}) - S/. {{ $actividad->precio }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>

                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end">
                            <a href="{{ route('admin.paquetes.index') }}" class="bg-gray-600 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 ml-4">
                                {{ __('Crear paquete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
