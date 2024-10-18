<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Destinos') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Buscador -->
                    <div class="mb-6 flex items-center space-x-4 w-full">
                        <form action="{{ route('destinos.index') }}" method="GET" class="flex items-center space-x-2 w-4/6">
                            <input type="text" name="search" placeholder="Buscar destinos..." class="border border-gray-300 rounded-md py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ request('search') }}">
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
                                    <x-dropdown-link :href="route('destinos.index', array_merge(request()->query(), ['ordenar' => 'recomendados']))">
                                        {{ __('Más recomendados') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <!-- Dropdown de "Categorías" -->
                        <div class="relative w-1/6">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button class="bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded hover:bg-gray-300 w-full">
                                        {{ request('categoria', 'Tipo de destino') }}
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Enlace para mostrar todas las categorías -->
                                    <x-dropdown-link :href="route('destinos.index')">
                                        {{ __('Todas las categorías') }}
                                    </x-dropdown-link>

                                    <!-- Listar todas las categorías para filtrar -->
                                    @foreach ($categorias as $categoria)
                                        <x-dropdown-link :href="route('destinos.index', array_merge(request()->query(), ['categoria' => $categoria->categoria]))">
                                            {{ $categoria->categoria }}
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <!-- Lista de destinos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if($destinos->isEmpty())
                            <p class="text-gray-500">{{ __('No hay destinos disponibles.') }}</p>
                        @else
                            @foreach ($destinos as $destino)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                    <div class="relative">
                                        @if ($destino->fotos->isNotEmpty())
                                            <!-- Mostrar la primera foto del destino -->
                                            <img src="{{ Storage::url($destino->fotos->first()->url) }}" alt="{{ $destino->nombre }}" class="w-full h-48 object-cover">
                                        @else
                                            <!-- Placeholder si no hay fotos -->
                                            <img src="https://via.placeholder.com/400x300.png?text=Sin+Foto" alt="{{ $destino->nombre }}" class="w-full h-48 object-cover">
                                        @endif
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-lg font-semibold mb-2">{{ $destino->nombre }}</h3>
                                        <p class="text-sm text-gray-600 mb-4">{{ Str::limit($destino->descripcion, 100) }}</p>

                                        <!-- Mostrar puntuación promedio si existen reseñas -->
                                        <div class="text-yellow-500 font-bold">
                                            @if($destino->resenas->count() > 0)
                                                {{ round($destino->resenas->avg('calificacion'), 1) . ' / 5' }}
                                            @else
                                                {{ __('Sin reseñas') }}
                                            @endif
                                        </div>

                                        <div class="flex items-center space-x-4 mt-4">
                                            <!-- Botón Ver más -->
                                            <a href="{{ route('destinos.show', $destino) }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
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
