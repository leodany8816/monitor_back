<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Storage;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = new Empresa();
        $empresa->nombre = 'POLITEL';
        $empresa->rfc = 'POL710601K54';
        $empresa->logo = 'logopolitel.png';
        $empresa->save();

        $empresa = new Empresa();
        $empresa->nombre = 'BEKAERT TEXTILES MEXICO';
        $empresa->rfc = 'BTM050131B20';
        $empresa->logo = 'logobekaert.png';
        $empresa->save();
    }
}
