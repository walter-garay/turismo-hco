<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HuánucoExplorer - Tu guía digital</title>

    <!-- Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <img src="/images/logo.png" alt="Logo HuánucoExplorer" class="h-10">
            </div>
            <div>
                @guest
                    <a href="/login" class="text-gray-800 mx-4 hover:underline">Iniciar sesión</a>
                    <a href="/register" class="text-gray-800 mx-4 hover:underline">Registrar</a>
                @endguest
                @auth
                    @if(Auth::user()->rol === 'admin')
                        <a href="/admin/destinos" class="text-gray-800 mx-4 hover:underline">Destinos</a>
                        <a href="/admin/paquetes" class="text-gray-800 mx-4 hover:underline">Paquetes</a>
                    @else
                        <a href="/destinos" class="text-gray-800 mx-4 hover:underline">Destinos</a>
                        <a href="/paquetes" class="text-gray-800 mx-4 hover:underline">Paquetes</a>
                    @endif
                @endauth

            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="bg-gray-100 text-gray-800 py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold">Bienvenido a HuánucoExplorer</h1>
            <p class="mt-4">Descubre los lugares turísticos más fascinantes de Huánuco</p>
        </div>
    </header>

    <!-- About Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-center md:text-left">
                <h2 class="text-3xl font-semibold text-gray-800">¿Qué es HuánucoExplorer?</h2>
                <p class="mt-4 text-gray-600">
                    HuánucoExplorer es tu guía digital para explorar los increíbles lugares turísticos de Huánuco. Desde impresionantes paisajes naturales hasta sitios históricos, te ayudamos a descubrir y planificar tu próxima aventura en esta maravillosa región.
                </p>
            </div>
            <div class="md:w-1/2 mt-8 md:mt-0">
                <img src="https://via.placeholder.com/600x400" alt="Imagen de turismo en Huánuco" class="w-full h-auto rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Featured Places Section -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Lugares Destacados</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <img src="https://via.placeholder.com/300" alt="Lugar turístico 1" class="w-full h-48 object-cover rounded-t-lg">
                    <h3 class="mt-4 text-xl font-bold text-gray-800">Cueva de las Lechuzas</h3>
                    <p class="mt-2 text-gray-600">Una cueva mística habitada por cientos de lechuzas en medio de la selva.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <img src="https://via.placeholder.com/300" alt="Lugar turístico 2" class="w-full h-48 object-cover rounded-t-lg">
                    <h3 class="mt-4 text-xl font-bold text-gray-800">Kotosh - Templo de las Manos Cruzadas</h3>
                    <p class="mt-2 text-gray-600">Un sitio arqueológico preincaico con más de 4000 años de antigüedad.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <img src="https://via.placeholder.com/300" alt="Lugar turístico 3" class="w-full h-48 object-cover rounded-t-lg">
                    <h3 class="mt-4 text-xl font-bold text-gray-800">Bosque de Piedra de Huayllay</h3>
                    <p class="mt-2 text-gray-600">Un bosque natural de impresionantes formaciones rocosas que parecen haber sido esculpidas por la naturaleza.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Testimonios</h2>
            <p class="mt-4 text-gray-600">Lo que nuestros usuarios dicen sobre HuánucoExplorer</p>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <p class="text-gray-700">"HuánucoExplorer me ayudó a planificar el viaje perfecto a Huánuco. ¡Recomiendo la plataforma al 100%!"</p>
                    <h4 class="mt-4 text-xl font-bold text-gray-800">- Maria Rodríguez</h4>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <p class="text-gray-700">"Gracias a HuánucoExplorer descubrí lugares que ni siquiera sabía que existían. ¡Una experiencia inolvidable!"</p>
                    <h4 class="mt-4 text-xl font-bold text-gray-800">- José Pérez</h4>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <p class="text-gray-700">"La mejor plataforma para explorar Huánuco. Fácil de usar y muy completa."</p>
                    <h4 class="mt-4 text-xl font-bold text-gray-800">- Laura García</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Contáctanos</h2>
            <p class="mt-4 text-gray-600">¿Tienes preguntas o necesitas más información? Escríbenos y te responderemos lo antes posible.</p>
            <div class="mt-8">
                <form action="#" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                    <div class="mb-4">
                        <label for="name" class="block text-left text-gray-700">Nombre Completo</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-left text-gray-700">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-left text-gray-700">Mensaje</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none" required></textarea>
                    </div>
                    <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} HuánucoExplorer. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
