<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actividades') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Botón para crear una nueva actividad -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.actividades.create') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                            {{ __('Agregar actividad') }}
                        </a>
                    </div>

                    <!-- Tabla de actividades -->
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('ID') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Nombre') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Tipo') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Fecha/Hora') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Categoría') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Destino') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Precio') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actividades as $actividad)
                                <tr x-data="{ open: false }">
                                    <td class="py-2 px-4 border-b">{{ $actividad->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $actividad->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ ucfirst($actividad->tipo) }}</td>

                                    <!-- Fecha y Horario -->
                                    <td class="py-2 px-4 border-b">
                                        <div>{{ $actividad->fecha_evento ? \Carbon\Carbon::parse($actividad->fecha_evento)->format('d/m/Y') : __('No definida') }}</div>
                                        <div class="text-sm text-gray-500">
                                            {{ $actividad->hora_inicio && $actividad->hora_fin
                                                ? \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') . ' - ' . \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i')
                                                : __('No definido') }}
                                        </div>
                                    </td>

                                    <td class="py-2 px-4 border-b">{{ $actividad->categoria ?? __('Sin categoría') }}</td>
                                    <td class="py-2 px-4 border-b">{{ $actividad->destino->nombre ?? __('Sin destino') }}</td>

                                    <!-- Precio -->
                                    <td class="py-2 px-4 border-b">
                                        {{ $actividad->precio ? 'S/. ' . number_format($actividad->precio, 2) : __('Gratis') }}
                                    </td>

                                    <td class="py-2 px-4 border-b flex space-x-2">
                                        <!-- Botón editar -->
                                        <a href="{{ route('admin.actividades.edit', $actividad->id) }}" class="text-blue-600 hover:text-blue-800">
                                            <x-pencil-icon class="w-4 h-4" />
                                        </a>

                                        <!-- Botón Eliminar -->
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
                                                        <h2 class="text-lg font-bold">{{ __('¿Estás seguro de eliminar esta actividad?') }}</h2>
                                                        <p class="mt-4">{{ __('Esta acción no podrá deshacerse después de confirmar.') }}</p>

                                                        <!-- Botones en el modal -->
                                                        <div class="mt-6 flex justify-end space-x-4">
                                                            <button @click="open = false" class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">
                                                                {{ __('Cancelar') }}
                                                            </button>

                                                            <!-- Formulario para eliminar -->
                                                            <form action="{{ route('admin.actividades.destroy', $actividad->id) }}" method="POST">
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

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $actividades->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
