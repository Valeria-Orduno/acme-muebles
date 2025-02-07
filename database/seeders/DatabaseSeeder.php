<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Producto::create([
            'nombre' => 'Escritorio de madera',
            'descripcion' => 'Escritorio premium de madera de roble.',
            'precio' => 2500.00,
            'categoria' => 'premium',
            'stock' => 10,
        ]);

        Producto::create([
            'nombre' => 'Silla ergonómica',
            'descripcion' => 'Silla de oficina cómoda y ajustable.',
            'precio' => 1200.00,
            'categoria' => 'básico',
            'stock' => 30,
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ejemplo.com',
            'password' => bcrypt('1234'),
            'role' => 'admin',
        ]);

        // Crear clientes de prueba
        $cliente1 = User::create([
            'name' => 'Cliente 1',
            'email' => 'cliente1@ejemplo.com',
            'password' => bcrypt('cliente123'),
            'role' => 'cliente',
        ]);

        Cliente::create([
            'user_id' => $cliente1->id,
            'tipo' => '3',
        ]);
    }
}
