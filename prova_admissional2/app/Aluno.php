<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aluno extends Model
{
    //
    protected $table = "alunos";
    public $primaryKey = "id";
    public $fillable = [
        'nome',
        'email',
        'senha',
        'ativo'
    ];

    public function getCursos(){
        return $this->belongsToMany(Curso::class, 'matriculas', 'aluno_id', 'curso_id')->where('matriculas.ativo', 1);
    }

}
