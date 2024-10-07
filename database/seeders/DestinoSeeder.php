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
    }
}
