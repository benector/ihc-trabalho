<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class ProjetoExtensao extends Model
{
    use HasFactory;
    protected $table = 'projetos_extensao';

    protected $fillable = [
        'titulo',
        'descricao',
        'area_id',
        'coordenador',
        'localidade',
        'data_inicio',
        'data_fim'
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function acoes()
    {
        return $this->hasMany(AcaoExtensao::class);
    }
}
