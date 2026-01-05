<?php

namespace Database\Factories;

use App\Models\ProjetoExtensao;
use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjetoExtensaoFactory extends Factory
{
    protected $model = ProjetoExtensao::class;


    public function definition(): array
    {
        $dataInicio = $this->faker->dateTimeBetween('-1 year', 'now');
        $dataFim = (clone $dataInicio)->modify('+' . rand(3, 12) . ' months');

        return [
            'titulo' => $this->faker->sentence(4),
            'descricao' => $this->faker->paragraph(6),
            'localidade' => $this->faker->city(),
            'coordenador' => $this->faker->name(),
            'area_id' => Area::inRandomOrder()->value('id'),
            'data_inicio' => $dataInicio->format('Y-m-d'),
            'data_fim' => $dataFim->format('Y-m-d'),
        ];
    }


}
