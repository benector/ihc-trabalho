<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function projetos()
    {
        return $this->belongsToMany(
            Projeto::class,
            'area_projeto',
            'area_id',
            'projeto_id'
        );
    }


    public function acoes()
    {
        return $this->hasMany(AcaoExtensao::class);
    }
}
