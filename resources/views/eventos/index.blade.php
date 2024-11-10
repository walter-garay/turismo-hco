<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Filtros por destino y categoría -->
                    <form action="{{ route('eventos.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                        <!-- Select para Destino -->
                        <div>
                            <label for="destino" class="block text-gray-700 font-semibold mb-2">{{ __('Filtrar por destino') }}</label>
                            <select name="destino" id="destino" class="border border-gray-300 rounded-md py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-600" onchange="this.form.submit()">
                                <option value="">{{ __('Todos los destinos') }}</option>
                                @foreach($destinos as $destino)
                                    <option value="{{ $destino->id }}" {{ $destino->id == $destinoId ? 'selected' : '' }}>{{ $destino->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select para Categoría -->
                        <div>
                            <label for="categoria" class="block text-gray-700 font-semibold mb-2">{{ __('Filtrar por categoría') }}</label>
                            <select name="categoria" id="categoria" class="border border-gray-300 rounded-md py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-600" onchange="this.form.submit()">
                                <option value="">{{ __('Todas las categorías') }}</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat }}" {{ $cat == $categoria ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <!-- Contenedor del calendario -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de FullCalendar -->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.6/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.6/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.6/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.6/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/es.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'listMonth', // Cambia la vista inicial a la vista de lista mensual
                locale: 'es',
                events: [
                    @foreach($eventos as $evento)
                    {
                        id: '{{ $evento->id }}',
                        title: '{{ $evento->nombre }}',
                        start: '{{ $evento->fecha_evento }}T{{ $evento->hora_inicio }}',
                        end: '{{ $evento->fecha_evento }}T{{ $evento->hora_fin }}',
                        url: '{{ route('eventos.show', $evento->id) }}'
                    },
                    @endforeach
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth,dayGridWeek,dayGridDay'
                },
                selectable: true,
                editable: false,
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Prevenir que se abra el enlace directamente
                    window.location.href = info.event.url; // Redirigir a la URL del evento
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>
