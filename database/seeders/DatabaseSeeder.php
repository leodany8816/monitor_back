<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Empresa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EmpresaSeeder::class);
        $this->call(UsuarioSeeder::class);
    }
}
