<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $usuario = new Usuario();
       $usuario->id_empresa='1';
       $usuario->usuario = 'POL710601K54';
       $usuario->password = bcrypt('POL710601K54');
       $usuario->estatus = '1';
       $usuario->token = 'nNFhKn76Vic';
       $usuario->save();

       $usuario = new Usuario();
       $usuario->id_empresa='2';
       $usuario->usuario = 'BTM050131B20';
       $usuario->password = bcrypt('BTM050131B20');
       $usuario->estatus = '1';
       $usuario->token = 'nNFhKn76Vic2';
       $usuario->save();
    }
}
