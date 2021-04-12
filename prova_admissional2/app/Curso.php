<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //
    protected $table = "cursos";
    public $primaryKey = "id";
    public $fillable = [
        'nome',
        'data_inicio',
        'ativo'
    ];

    

    public function getAlunos(){
        return $this->belongsToMany(Aluno::class, 'matriculas', 'curso_id', 'aluno_id')->where('matriculas.ativo', 1);
    }
}
