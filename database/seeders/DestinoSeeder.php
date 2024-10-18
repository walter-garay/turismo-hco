<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destino;

class DestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear destinos
        Destino::create([
            'nombre' => 'Machu Picchu',
            'descripcion' => 'Una de las siete maravillas del mundo, ubicada en los Andes peruanos.',
            'ubicacion' => 'Cusco, Perú',
            'direccion' => 'Santuario Histórico de Machu Picchu',
            'latitud' => -13.1631,
            'longitud' => -72.5450,
            'historia' => 'Construido en el siglo XV por el emperador inca Pachacútec.',
            'categoria' => 'Arqueológico'
        ]);

        Destino::create([
            'nombre' => 'Huayna Picchu',
            'descripcion' => 'La montaña que se alza detrás de las ruinas de Machu Picchu.',
            'ubicacion' => 'Cusco, Perú',
            'direccion' => 'Huayna Picchu',
            'latitud' => -13.1580,
            'longitud' => -72.5449,
            'historia' => 'Parte del conjunto arqueológico de Machu Picchu, ofrece vistas espectaculares.',
            'categoria' => 'Montaña'
        ]);

        // Agrega un tercer destino: Lago Titicaca
        Destino::create([
            'nombre' => 'Lago Titicaca',
            'descripcion' => 'El lago navegable más alto del mundo, compartido entre Perú y Bolivia.',
            'ubicacion' => 'Puno, Perú',
            'direccion' => 'Lago Titicaca',
            'latitud' => -15.7652,
            'longitud' => -69.5310,
            'historia' => 'Lugar de origen de la leyenda inca del dios Sol y la creación del primer inca.',
            'categoria' => 'Natural'
        ]);

        // Agrega un cuarto destino de ejemplo
        Destino::create([
            'nombre' => 'Valle Sagrado de los Incas',
            'descripcion' => 'Un conjunto de valles y tierras fértiles en los Andes peruanos, antiguo centro agrícola de los incas.',
            'ubicacion' => 'Cusco, Perú',
            'direccion' => 'Valle Sagrado',
            'latitud' => -13.2992,
            'longitud' => -72.1305,
            'historia' => 'Centro agrícola clave para los incas debido a su clima templado y tierras fértiles.',
            'categoria' => 'Cultural'
        ]);
    }
}
