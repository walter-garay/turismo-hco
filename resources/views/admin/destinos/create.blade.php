<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nuevo destino') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.destinos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nombre y Categoría (en la misma fila) -->
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="col-span-2">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">{{ __('Nombre del destino') }}</label>
                                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="categoria" class="block text-sm font-medium text-gray-700">{{ __('Categoría') }}</label>
                                <input type="text" name="categoria" id="categoria" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('categoria') }}" required>
                                @error('categoria')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección y Ubicación (en la misma fila) -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700">{{ __('Dirección') }}</label>
                                <input type="text" name="direccion" id="direccion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('direccion') }}">
                                @error('direccion')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="ubicacion" class="block text-sm font-medium text-gray-700">{{ __('Ubicación') }}</label>
                                <input type="text" name="ubicacion" id="ubicacion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('ubicacion') }}">
                                @error('ubicacion')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Latitud y Longitud (en la misma fila) -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="latitud" class="block text-sm font-medium text-gray-700">{{ __('Latitud') }}</label>
                                <input type="number" step="0.0000001" name="latitud" id="latitud" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('latitud') }}">
                                @error('latitud')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="longitud" class="block text-sm font-medium text-gray-700">{{ __('Longitud') }}</label>
                                <input type="number" step="0.0000001" name="longitud" id="longitud" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('longitud') }}">
                                @error('longitud')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">{{ __('Descripción') }}</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Historia -->
                        <div class="mb-4">
                            <label for="historia" class="block text-sm font-medium text-gray-700">{{ __('Historia') }}</label>
                            <textarea name="historia" id="historia" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('historia') }}</textarea>
                            @error('historia')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fotos -->
                        <div class="mb-4">
                            <label for="fotos" class="block text-sm font-medium text-gray-700">{{ __('Fotos del destino') }}</label>
                            <input type="file" name="fotos[]" id="fotos" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
                            @error('fotos.*')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end">
                            <a href="{{ route('admin.destinos.index') }}" class="bg-gray-600 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 ml-4">
                                {{ __('Crear destino') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
