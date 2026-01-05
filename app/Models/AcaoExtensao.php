<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcaoExtensao extends Model {
    protected $table = 'acoes_extensao';

    protected $fillable = [
        'titulo', 'descricao', 'area_id',
        'local', 'responsavel',
        'data_inicio', 'data_fim'
    ];

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function projeto()
    {
        return $this->belongsTo(ProjetoExtensao::class, 'projeto_extensao_id');
    }

}

