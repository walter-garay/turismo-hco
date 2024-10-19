<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paquete turístico') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex">
                    <!-- Columna izquierda: Carrusel de imágenes del destino o Placeholder -->
                    <div class="w-1/3 pr-6">
                        @if($paquete->destino->fotos->isNotEmpty())
                            <div id="carouselExample" class="carousel slide mb-6" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($paquete->destino->fotos as $index => $foto)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ Storage::url($foto->url) }}" class="d-block w-full h-72 object-cover" alt="Foto de {{ $paquete->destino->nombre }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <img src="https://via.placeholder.com/400x300.png?text=Sin+Foto" alt="Sin foto" class="w-full h-72 object-cover">
                        @endif
                    </div>

                    <!-- Columna derecha: Información del paquete -->
                    <div class="w-2/3">
                        <!-- Botón Volver -->
                        <div class="mb-2 justify-between flex ">
                            <p>{{ $paquete->destino->ubicacion }}</p>
                            <a href="{{ route('paquetes.index') }}" class="text-blue-600 hover:underline">
                                {{ __('← Volver a la lista de paquetes') }}
                            </a>
                        </div>

                        <h3 class="text-3xl font-bold mb-4">{{ $paquete->nombre }}</h3>
                        <div class="space-y-4">
                            <p class="bg-blue-100 border-blue-600 border-2 text-blue-600 font-semibold rounded-md w-fit px-2 ">{{ $paquete->destino->nombre }}</p>

                            <!-- Información del paquete -->
                            <div class="text-gray-600 font-semibold">
                                <p><strong>{{ __('Duración:') }}</strong> {{ $paquete->duracion }} {{ __('días') }}</p>
                                <p><strong>{{ __('Precio por persona:') }}</strong> S/. {{ $paquete->precio_individual }}</p>
                            </div>

                            <!-- Botón Realizar reserva -->
                            <a href="{{ route('reservas.create', ['paquete_id' => $paquete->id]) }}" class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 mt-4 inline-block">
                                {{ __('Realizar reserva') }}
                            </a>

                        </div>

                        <!-- Mapa de Google incrustado -->
                        <div class="mt-6">
                            <h4 class="font-semibold">{{ __('Ubicación en el mapa') }}</h4>
                            <div class="mt-2 rounded-lg overflow-hidden">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d245.0486190222401!2d{{ $paquete->destino->longitud }}!3d{{ $paquete->destino->latitud }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1728408859233!5m2!1ses-419!2spe"
                                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>

                        <!-- Sección de actividades incluidas en el paquete -->
                        <div class="mt-10">
                            <h4 class="text-xl font-semibold">{{ __('Actividades incluidas en el paquete') }}</h4>
                            @if($paquete->actividades->isNotEmpty())
                                <table class="table-auto w-full mt-4">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left">{{ __('Nombre') }}</th>
                                            <th class="px-4 py-2 text-left">{{ __('Horario') }}</th>
                                            <th class="px-4 py-2 text-left">{{ __('Duración') }}</th>
                                            <th class="px-4 py-2 text-left">{{ __('Precio normal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paquete->actividades as $actividad)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $actividad->nombre }}</td>
                                                <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i') }}</td>
                                                <td class="border px-4 py-2">{{ $actividad->duracion }} {{ __('min') }}</td>
                                                <td class="border px-4 py-2"> {{ __('S/.') }} {{ $actividad->precio }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-gray-500">{{ __('No hay actividades registradas para este paquete aún.') }}</p>
                            @endif
                        </div>

                        <br>

                        <!-- Sección de reseñas del destino -->
                        <div class="mt-10">
                            <h4 class="text-xl font-semibold">{{ __('Reseñas del destino') }}</h4>
                            @if($paquete->destino->resenas->isNotEmpty())
                                @foreach($paquete->destino->resenas as $resena)
                                    <div class="mt-4 p-4 border rounded-lg bg-gray-100">
                                        <span class="text-sm font-medium text-green-600">{{ $resena->usuario->nombre }}</span>
                                        <p class="text-gray-800 text-base">{{ $resena->comentarios }}</p>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-sm text-gray-600">{{ __('Calificación: ') . $resena->calificacion . __(' / 5')  }}</span>
                                            <span class="text-sm text-gray-600">{{ $resena->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-500">{{ __('No hay reseñas para este destino aún.') }}</p>
                            @endif
                        </div>

                        <!-- Formulario para agregar una reseña -->
                        <div class="mt-8">
                            <h4 class="text-xl font-semibold">{{ __('Comparte tu experiencia') }}</h4>
                            <form action="{{ route('resenas.store', $paquete->destino->id) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="calificacion" class="block text-sm font-medium text-gray-700">{{ __('Calificación (0 a 5)') }}</label>
                                    <input type="number" step="0.1" name="calificacion" id="calificacion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="0" max="5" required>
                                    @error('calificacion')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="comentarios" class="block text-sm font-medium text-gray-700">{{ __('Comentario') }}</label>
                                    <textarea name="comentarios" id="comentarios" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                                    @error('comentarios')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700">
                                    {{ __('Enviar reseña') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
