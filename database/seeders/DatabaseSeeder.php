<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
  public function run(): void
    {
        User::create([
             'name' => 'Administrador',
             'email' => 'admin@ufjf.br',
            'cpf' => '000.000.000-00',
             'password' => bcrypt('12345678'),
             'is_admin' => true,
         ]);

        $this->call(AreaSeeder::class);

        

        \App\Models\ProjetoExtensao::factory()->count(15)->create();

        \App\Models\User::factory()->count(5)->create(); // professores
        \App\Models\User::factory()->count(20)->create(); // alunos
    }

}
