<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paquetes turísticos') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Botón para crear un nuevo paquete turístico -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.paquetes.create') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                            {{ __('Agregar paquete turístico') }}
                        </a>
                    </div>

                    <!-- Tabla de paquetes turísticos -->
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('ID') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Nombre') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Descripción') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Duración (días)') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Precio Individual') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paquetes as $paquete)
                                <tr x-data="{ open: false }">
                                    <td class="py-2 px-4 border-b">{{ $paquete->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $paquete->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ Str::limit($paquete->descripcion, 50) }}</td>
                                    <td class="py-2 px-4 border-b">{{ $paquete->duracion }}</td>
                                    <td class="py-2 px-4 border-b">{{ __('S/.') }}{{ $paquete->precio_individual }}</td>
                                    <td class="py-2 px-4 border-b flex space-x-2">
                                        <!-- Botón editar -->
                                        <a href="{{ route('admin.paquetes.edit', $paquete->id) }}" class="text-blue-600 hover:text-blue-800">
                                            <x-pencil-icon class="w-4 h-4" />
                                        </a>

                                        <!-- Botón eliminar -->
                                        <button class="text-red-600 hover:text-red-800 ml-4" @click="open = true">
                                            <x-trash-icon class="w-4 h-4" />
                                        </button>

                                        <!-- Modal de Confirmación para eliminar -->
                                        <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto mt-20">
                                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                                </div>

                                                <!-- Modal Content -->
                                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto">
                                                    <div class="p-6 text-left">
                                                        <h2 class="text-lg font-bold">{{ __('¿Estás seguro de eliminar este paquete?') }}</h2>
                                                        <p class="mt-4">{{ __('Esta acción no podrá deshacerse después de confirmar.') }}</p>

                                                        <!-- Botones en el modal -->
                                                        <div class="mt-6 flex justify-end space-x-4">
                                                            <button @click="open = false" class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">
                                                                {{ __('Cancelar') }}
                                                            </button>

                                                            <!-- Formulario para eliminar -->
                                                            <form action="{{ route('admin.paquetes.destroy', $paquete->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="bg-red-600 text-white font-bold py-2 px-4 rounded hover:bg-red-700">
                                                                    {{ __('Confirmar') }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginación (opcional) -->
                    <div class="mt-4">
                        {{ $paquetes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
