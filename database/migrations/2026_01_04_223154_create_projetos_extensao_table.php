<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projetos_extensao', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->foreignId('area_id')->constrained('areas')->cascadeOnDelete();
            $table->string('coordenador');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projetos_extensao');
    }
};

