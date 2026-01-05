<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            'Ciências Exatas e da Terra',
            'Ciências Biológicas',
            'Engenharias',
            'Ciências da Saúde',
            'Ciências Agrárias',
            'Ciências Sociais Aplicadas',
            'Ciências Humanas',
            'Computação',
            'Linguística, Letras e Artes',
            'Interdisciplinar',
        ];

        foreach ($areas as $nome) {
            Area::firstOrCreate(['nome' => $nome]);
        }
    }
}
