<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('area_projeto', function (Blueprint $table) {
            $table->id();

            $table->foreignId('projeto_id')
                ->constrained('projetos_extensao')
                ->cascadeOnDelete();

            $table->foreignId('area_id')
                ->constrained('areas')
                ->cascadeOnDelete();

            $table->unique(['projeto_id', 'area_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area_projeto');
    }
};
