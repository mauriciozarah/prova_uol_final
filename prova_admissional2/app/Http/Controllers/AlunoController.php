<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Curso;
use App\Matricula;
use App\Http\Traits\TraitHelper;
date_default_timezone_set('America/Sao_Paulo');

class AlunoController extends Controller
{
    use TraitHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::orderBy('id','DESC')->get();
        return view('aluno_list', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cursos = Curso::orderBy('nome', 'ASC')->get();
        return view('aluno_create', compact('cursos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nome'   => 'required|min:3|max:100', 
            'email'  => 'required|email|unique:alunos|min:3|max:100',
            'senha'  => 'required_with:senhac|same:senhac|min:3|max:50'
        ]);

        $v['nome']  = $request['nome'];
        $v['email'] = $request['email'];
        $v['ativo'] = 1;
        $v['senha'] = sha1($request['senha']);

        $aluno = Aluno::create($v);

        $msg = $aluno ? "Aluno inserido com Sucesso." : "Erro ao cadastrar Aluno";

        
        foreach($request['curso_id'] as $id_curso):
            if($id_curso):
                $vet['ativo'] = 1;
                $vet['data_admissao'] = date('Y-m-d H:i:s');
                $vet['curso_id'] = $id_curso;
                $vet['aluno_id'] = $aluno->id;
                Matricula::create($vet);
            endif;
        endforeach;

        return redirect()->route('aluno_list')->with('status', $msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resAluno      = Aluno::findOrFail($id);
        $resMatricula  = Matricula::where('aluno_id',$id)->where('ativo', 1)->get();
        $resCurso      = Curso::orderBy('nome', 'ASC')->get();
        $qtdCurso      = (count($resCurso) + 1);
        $qtdMatricula  = count($resMatricula);

        return view('aluno_edit', compact('resAluno', 'resMatricula', 'resCurso', 'qtdCurso', 'qtdMatricula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'nome'      => 'required|min:3|max:100', 
            'email'     => 'required|email|min:3|max:100',
            'email_old' => 'required|email|min:3|max:100',
            'aluno_id'  => 'required|integer|min:1|max:11'
        ]);

        $aluno['nome']      =  $request['nome'];
        $aluno['email']     =  $request['email'];

        $email_old      =  $request['email_old'];
        $aluno_id       =  $request['aluno_id'];

        if($request['senha'] != ""):
            $aluno['senha'] = sha1($request['senha']);
        endif;

        if($aluno['email'] != $email_old):
            $res = Aluno::where('email', $aluno['email'])->get();
            if($res):
                return redirect()->route('aluno_list')->with('status', 'E-mail já cadastrado.');
            endif;
        endif;

        // atualizando o aluno
        Aluno::where('id', $aluno_id)->update($aluno);

        // desativando as matriculas
        Matricula::where('aluno_id', $aluno_id)->update(['ativo' => 0]);

        // inserindo novamente as matriculas
        $matricula['ativo'] = 1;
        $matricula['data_admissao'] = date('Y-m-d H:i:s');
        $matricula['aluno_id']  = $aluno_id;

        foreach($request['curso_id'] as $curso):
            if($curso != ""):
                $matricula['curso_id'] = $curso;
                Matricula::insert($matricula);
            endif;
        endforeach;

        return redirect()->route('aluno_list')->with('status', 'Editado com Sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function aluno_vs_curso(){
        $alunosXcursos = Aluno::orderBy('id', 'DESC')->get();
        return view('aluno_vs_curso', compact('alunosXcursos'));
    }

    public function disable($id){
        $aluno = Aluno::findOrFail($id);
        $aluno->ativo = 0;
        $aluno->save();
        return redirect()->route('aluno_list')->with('status', 'Desabilitado com Sucesso!');
    }
}
