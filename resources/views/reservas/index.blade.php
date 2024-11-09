<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis reservas') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Tabla de reservas -->
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('ID') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Paquete') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Destino') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Fecha de Reserva') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Número de Personas') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Precio Total') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Estado') }}</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reservas as $reserva)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $reserva->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $reserva->paquete->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ $reserva->paquete->destino->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($reserva->fecha_reserva)->format('d/m/Y H:i') }}</td>
                                    <td class="py-2 px-4 border-b">{{ $reserva->num_personas }}</td>
                                    <td class="py-2 px-4 border-b">S/. {{ number_format($reserva->precio_total, 2) }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @if ($reserva->estado === 'pendiente de pago')
                                            <a href="https://wa.me/51944810018?text=Hola,%20quiero%20realizar%20el%20pago%20de%20mi%20reservación%20ID%20{{ $reserva->id }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 underline">
                                                {{ __('Realizar el pago') }}
                                            </a>
                                        @else
                                            {{ ucfirst($reserva->estado) }}
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b flex space-x-2">
                                        @if ($reserva->estado === 'pendiente de pago')
                                            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 ml-4">
                                                    <x-trash-icon class="w-4 h-4" />
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-2 px-4 border-b text-center text-gray-500">{{ __('No tienes reservas realizadas.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $reservas->links() }} <!-- Mostrar los links de paginación -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
