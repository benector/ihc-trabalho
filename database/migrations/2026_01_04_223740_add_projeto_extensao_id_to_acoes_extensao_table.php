<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('acoes_extensao', function (Blueprint $table) {
            $table->foreignId('projeto_extensao_id')
                  ->nullable()
                  ->after('area_id')
                  ->constrained('projetos_extensao')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('acoes_extensao', function (Blueprint $table) {
            $table->dropForeign(['projeto_extensao_id']);
            $table->dropColumn('projeto_extensao_id');
        });
    }
};
