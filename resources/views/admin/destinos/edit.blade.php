<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar destino: ') . $destino->nombre }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.destinos.update', $destino->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nombre y Categoría (en la misma fila) -->
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="col-span-2">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">{{ __('Nombre del destino') }}</label>
                                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nombre', $destino->nombre) }}" required>
                                @error('nombre')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="categoria" class="block text-sm font-medium text-gray-700">{{ __('Categoría') }}</label>
                                <input type="text" name="categoria" id="categoria" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('categoria', $destino->categoria) }}" required>
                                @error('categoria')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección y Ubicación (en la misma fila) -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700">{{ __('Dirección') }}</label>
                                <input type="text" name="direccion" id="direccion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('direccion', $destino->direccion) }}">
                                @error('direccion')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="ubicacion" class="block text-sm font-medium text-gray-700">{{ __('Ubicación') }}</label>
                                <input type="text" name="ubicacion" id="ubicacion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('ubicacion', $destino->ubicacion) }}">
                                @error('ubicacion')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Latitud y Longitud (en la misma fila) -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="latitud" class="block text-sm font-medium text-gray-700">{{ __('Latitud') }}</label>
                                <input type="number" step="0.0000001" name="latitud" id="latitud" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('latitud', $destino->latitud) }}">
                                @error('latitud')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="longitud" class="block text-sm font-medium text-gray-700">{{ __('Longitud') }}</label>
                                <input type="number" step="0.0000001" name="longitud" id="longitud" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('longitud', $destino->longitud) }}">
                                @error('longitud')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">{{ __('Descripción') }}</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion', $destino->descripcion) }}</textarea>
                            @error('descripcion')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Historia -->
                        <div class="mb-4">
                            <label for="historia" class="block text-sm font-medium text-gray-700">{{ __('Historia') }}</label>
                            <textarea name="historia" id="historia" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('historia', $destino->historia) }}</textarea>
                            @error('historia')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fotos -->
                        <div class="mb-4">
                            <label for="fotos" class="block text-sm font-medium text-gray-700">{{ __('Subir nuevas fotos del destino') }}</label>
                            <input type="file" name="fotos[]" id="fotos" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
                            @error('fotos.*')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror

                            <!-- Mostrar las fotos actuales -->
                            @if ($destino->fotos->isNotEmpty())
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-700">{{ __('Fotos actuales') }}:</h4>
                                    <div class="grid grid-cols-3 gap-4 mt-2">
                                        @foreach ($destino->fotos as $foto)
                                            <div class="relative" x-data="{ open: false }">
                                                <img src="{{ Storage::url($foto->url) }}" alt="{{ $destino->nombre }}" class="w-full h-32 object-cover rounded-md shadow cursor-pointer" @click="open = true">

                                                <!-- Modal para mostrar imagen en grande -->
                                                <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                <img src="{{ Storage::url($foto->url) }}" alt="{{ $destino->nombre }}" class="w-full h-auto">
                                                            </div>
                                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                <!-- Aseguramos que este botón sea de tipo "button" -->
                                                                <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                                    {{ __('Cerrar') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end">
                            <a href="{{ route('admin.destinos.index') }}" class="bg-gray-600 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">
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
