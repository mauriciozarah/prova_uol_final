<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Matricula extends Model
{
    //
    protected $table = "matriculas";
    protected $primaryKey = "id";
    protected $fillable = [
        'ativo',
        'data_admissao',
        'curso_id',
        'aluno_id'
    ];

    public static function listar(){
        return DB::select('
                    SELECT
                        DISTINCT(matriculas.curso_id) AS curso_id,
                        matriculas.aluno_id,
                        matriculas.data_admissao, 
                        matriculas.ativo as matricula_ativa,
                        cursos.nome as curso, 
                        alunos.nome as aluno 
                    FROM 
                        matriculas 
                    LEFT JOIN 
                        alunos 
                    ON 
                        matriculas.aluno_id = alunos.id 
                    LEFT JOIN 
                        cursos 
                    ON 
                        matriculas.curso_id = cursos.id 
                    ');
    }
}
