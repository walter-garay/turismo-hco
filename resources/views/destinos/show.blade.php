<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Destinos') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex">
                    <!-- Columna izquierda: Carrusel de imágenes o Placeholder -->
                    <div class="w-1/3 pr-6">
                        @if($destino->fotos->isNotEmpty())
                            <!-- Carrusel de imágenes -->
                            <div id="carouselExample" class="carousel slide mb-6" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($destino->fotos as $index => $foto)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ Storage::url($foto->url) }}" class="d-block w-full h-72 object-cover" alt="Foto de {{ $destino->nombre }}">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </div>
                        @else
                            <!-- Imagen de placeholder si no hay fotos -->
                            <img src="https://via.placeholder.com/400x300.png?text=Sin+Foto" alt="Sin foto" class="w-full h-72 object-cover">
                        @endif
                    </div>

                    <!-- Columna derecha: Información del destino -->
                    <div class="w-2/3">
                        <h3 class="text-3xl font-bold mb-4">{{ $destino->nombre }}</h3>
                        <div class="space-y-4">
                            <div class="text-gray-600 font-semibold">
                                <p>{{ $destino->ubicacion }}</p>
                                <p>{{ $destino->direccion }}</p>
                            </div>
                            <p class="bg-blue-100 border-blue-600 border-2 text-blue-600 font-semibold rounded-md w-min px-2">{{ $destino->categoria }}</p>
                            <p class="text-gray-600">{{ $destino->descripcion }}</p>
                        </div>

                        <!-- Botón Agregar al Itinerario -->
                        <div class="mt-6">
                            <button class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700">
                                {{ __('Agregar al Itinerario') }}
                            </button>
                        </div>

                        <!-- Botón Volver -->
                        <div class="mt-6">
                            <a href="{{ route('destinos.index') }}" class="text-blue-600 hover:underline">
                                {{ __('← Volver a la lista de destinos') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
