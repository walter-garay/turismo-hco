<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'nombre' => 'Administrador',
            'email' => 'admin@he.com',
            'password' => Hash::make('admin@he.com'), 
            'dni' => '74351766',  
            'celular' => '987654321',
            'rol' => 'admin', 
        ]);

        // Crear usuario turista
        User::create([
            'nombre' => 'Turista',
            'email' => 'turista@he.com',
            'password' => Hash::make('turista@he.com'),
            'dni' => '87654321', 
            'celular' => '912345678',  
            'rol' => 'turista', 
        ]);
    }
}
