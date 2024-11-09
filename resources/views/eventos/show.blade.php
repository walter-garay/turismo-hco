<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Evento') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Botón de regreso -->
                    <div class="mb-4">
                        <a href="{{ route('eventos.index') }}" class="flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            {{ __('Volver al calendario') }}
                        </a>
                    </div>

                    <!-- Información del Evento -->
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $evento->nombre }}</h3>
                    <p class="text-gray-600 mb-6">{{ $evento->descripcion ?? __('No hay descripción disponible.') }}</p>

                    <!-- Información del Destino -->
                    @if ($evento->destino)
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold text-gray-700 mb-2">{{ __('Destino:') }} {{ $evento->destino->nombre }}</h4>
                            <p class="text-gray-600 mb-4">{{ $evento->destino->descripcion ?? __('Descripción no disponible.') }}</p>
                            @if ($evento->destino->fotos->isNotEmpty())
                                <!-- Mostrar la primera foto del destino -->
                                <img src="{{ Storage::url($evento->destino->fotos->first()->url) }}" alt="{{ $evento->destino->nombre }}" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                            @else
                                <img src="https://via.placeholder.com/400x300.png?text=Sin+Foto" alt="Sin foto" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                            @endif
                        </div>
                    @endif

                    <!-- Detalles específicos del evento -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>{{ __('Fecha del evento:') }}</strong> {{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y') }}</p>
                            <p><strong>{{ __('Hora de inicio:') }}</strong> {{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }}</p>
                            <p><strong>{{ __('Hora de fin:') }}</strong> {{ \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') }}</p>
                        </div>
                        <div>
                            <p><strong>{{ __('Duración:') }}</strong> {{ $evento->duracion }} minutos</p>
                            <p><strong>{{ __('Precio:') }}</strong> S/. {{ number_format($evento->precio, 2) }}</p>
                            <p><strong>{{ __('Categoría:') }}</strong> {{ $evento->categoria ?? __('No disponible') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
