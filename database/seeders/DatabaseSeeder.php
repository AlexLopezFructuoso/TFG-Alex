<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
$this->call([PersonaSeeder::class]);
$this->call([ProductoSeeder::class]);
$this->call([FacturaSeeder::class]);
$this->call([Factura_productoSeeder::class]);
$this->call([DeudaSeeder::class]);
$this->call([PagoSeeder::class]);







        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
