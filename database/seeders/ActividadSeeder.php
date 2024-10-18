<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Actividad;
use App\Models\Destino;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los destinos por su nombre
        $machuPicchu = Destino::where('nombre', 'Machu Picchu')->first();
        $huaynaPicchu = Destino::where('nombre', 'Huayna Picchu')->first();

        // Crear actividades para Machu Picchu
        Actividad::create([
            'nombre' => 'Tour Guiado en Machu Picchu',
            'descripcion' => 'Explora las ruinas de Machu Picchu con un guía experimentado.',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '12:00:00',
            'duracion' => 240, // en minutos
            'precio' => 50.00, // Precio en USD
            'tipo' => 'actividad',
            'categoria' => 'Cultural',
            'fecha_evento' => '2024-11-15',
            'destino_id' => $machuPicchu->id
        ]);

        Actividad::create([
            'nombre' => 'Amanecer en Machu Picchu',
            'descripcion' => 'Disfruta del amanecer en Machu Picchu desde los mejores puntos de observación.',
            'hora_inicio' => '05:30:00',
            'hora_fin' => '07:30:00',
            'duracion' => 120,
            'precio' => 20.00,
            'tipo' => 'actividad',
            'categoria' => 'Aventura',
            'fecha_evento' => '2024-11-16',
            'destino_id' => $machuPicchu->id
        ]);

        Actividad::create([
            'nombre' => 'Senderismo a Puerta del Sol',
            'descripcion' => 'Caminata hacia la famosa Puerta del Sol, disfrutando de las vistas panorámicas.',
            'hora_inicio' => '07:00:00',
            'hora_fin' => '11:00:00',
            'duracion' => 240,
            'precio' => 15.00,
            'tipo' => 'actividad',
            'categoria' => 'Aventura',
            'fecha_evento' => '2024-11-17',
            'destino_id' => $machuPicchu->id
        ]);

        // Crear actividades para Huayna Picchu
        Actividad::create([
            'nombre' => 'Escalada Huayna Picchu',
            'descripcion' => 'Sube hasta la cima de Huayna Picchu para vistas espectaculares de Machu Picchu.',
            'hora_inicio' => '09:00:00',
            'hora_fin' => '11:00:00',
            'duracion' => 120,
            'precio' => 60.00,
            'tipo' => 'actividad',
            'categoria' => 'Aventura',
            'fecha_evento' => '2024-11-18',
            'destino_id' => $huaynaPicchu->id
        ]);

        Actividad::create([
            'nombre' => 'Fotografía en Huayna Picchu',
            'descripcion' => 'Toma fotografías únicas desde Huayna Picchu con vistas de Machu Picchu.',
            'hora_inicio' => '12:00:00',
            'hora_fin' => '14:00:00',
            'duracion' => 120,
            'precio' => 30.00,
            'tipo' => 'actividad',
            'categoria' => 'Fotografía',
            'fecha_evento' => '2024-11-19',
            'destino_id' => $huaynaPicchu->id
        ]);

        Actividad::create([
            'nombre' => 'Tour de la Montaña Huayna Picchu',
            'descripcion' => 'Un recorrido completo por la montaña Huayna Picchu y su conexión con Machu Picchu.',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '12:00:00',
            'duracion' => 240,
            'precio' => 45.00,
            'tipo' => 'actividad',
            'categoria' => 'Cultural',
            'fecha_evento' => '2024-11-20',
            'destino_id' => $huaynaPicchu->id
        ]);
    }
}
