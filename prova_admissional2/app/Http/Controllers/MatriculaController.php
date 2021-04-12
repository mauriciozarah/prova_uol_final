<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;

class MatriculaController extends Controller
{
    //
    public function index(){
        $result = Matricula::listar();
        return view('matricula_list', compact('result'));
    }

    public function disable(int $aluno_id, int $curso_id){
    	$res = Matricula::where('aluno_id', $aluno_id)->where('curso_id', $curso_id)->update(['ativo' => 0]);
    	if($res):
    		return redirect()->route('matricula_list')->with('status', 'Editado com Sucesso');
    	endif;
    }

    public function enable(int $aluno_id, int $curso_id){
    	$res = Matricula::where('aluno_id', $aluno_id)->where('curso_id', $curso_id)->update(['ativo' => 1]);
    	if($res):
    		return redirect()->route('matricula_list')->with('status', 'Editado com Sucesso');
    	endif;
    }
}
