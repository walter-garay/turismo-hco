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

                    <!-- Buscador -->
                    <div class="mb-6 flex items-center space-x-4 w-full">
                        <form action="{{ route('paquetes.index') }}" method="GET" class="flex items-center space-x-2 w-4/6">
                            <input type="text" name="search" placeholder="Buscar paquetes..." class="border border-gray-300 rounded-md py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ request('search') }}">
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                                {{ __('Buscar') }}
                            </button>
                        </form>

                        <!-- Dropdown de "Ordenar por" -->
                        <div class="relative w-1/6">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button class="bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded hover:bg-gray-300 w-full">
                                        {{ __('Ordenar por') }}
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('paquetes.index', array_merge(request()->query(), ['ordenar' => 'precio']))">
                                        {{ __('Precio') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('paquetes.index', array_merge(request()->query(), ['ordenar' => 'duracion']))">
                                        {{ __('Duración') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <!-- Dropdown de "Destinos" -->
                        <div class="relative w-1/6">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button class="bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded hover:bg-gray-300 w-full">
                                        {{ request('destino', 'Destino') }}
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Enlace para mostrar todos los paquetes -->
                                    <x-dropdown-link :href="route('paquetes.index')">
                                        {{ __('Todos los destinos') }}
                                    </x-dropdown-link>

                                    <!-- Listar todos los destinos para filtrar -->
                                    @foreach ($destinos as $destino)
                                        <x-dropdown-link :href="route('paquetes.index', array_merge(request()->query(), ['destino' => $destino->id]))">
                                            {{ $destino->nombre }}
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <!-- Lista de paquetes turísticos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if($paquetes->isEmpty())
                            <p class="text-gray-500">{{ __('No hay paquetes turísticos disponibles.') }}</p>
                        @else
                            @foreach ($paquetes as $paquete)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                    <div class="relative">
                                        @if ($paquete->destino->fotos->isNotEmpty())
                                            <!-- Mostrar la primera foto del destino -->
                                            <img src="{{ Storage::url($paquete->destino->fotos->first()->url) }}" alt="{{ $paquete->destino->nombre }}" class="w-full h-48 object-cover ">
                                        @else
                                            <!-- Placeholder si no hay fotos -->
                                            <img src="https://via.placeholder.com/400x300.png?text=Sin+foto" alt="{{ $paquete->destino->nombre }}" class="w-full h-48 object-cover">
                                        @endif
                                    </div>
                                    <div class="p-6">
                                        <!-- Nombre del destino arriba del paquete en texto pequeño -->
                                        <span class="text-sm font-semibold">{{ $paquete->destino->nombre }}</span>

                                        <!-- Nombre del paquete -->
                                        <h3 class="text-lg font-semibold mb-2 text-gray-400">{{ $paquete->nombre }}</h3>

                                        <!-- Duración y precio -->
                                        <div class="text-sm text-gray-500">
                                            <span class="block"><strong>{{ __('Duración:') }}</strong> {{ $paquete->duracion }} {{ __('días') }}</span>
                                            <span class="block"><strong>{{ __('Precio por persona:') }}</strong> S/. {{ $paquete->precio_individual }}</span>
                                        </div>

                                        <div class="flex items-center space-x-4 mt-4">
                                            <!-- Botón Ver más -->
                                            <a href="{{ route('paquetes.show', $paquete) }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                                                {{ __('Ver más') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
