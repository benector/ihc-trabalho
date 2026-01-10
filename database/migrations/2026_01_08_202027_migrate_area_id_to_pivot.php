<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $projetos = DB::table('projetos_extensao')
            ->whereNotNull('area_id')
            ->get();

        foreach ($projetos as $projeto) {
            DB::table('area_projeto')->insert([
                'projeto_id' => $projeto->id,
                'area_id'    => $projeto->area_id,
            ]);
        }
    }

    public function down(): void
    {
        DB::table('area_projeto')->truncate();
    }
};

