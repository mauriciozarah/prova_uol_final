<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Http\Traits\TraitHelper;
date_default_timezone_set('America/Sao_Paulo');

class CursoController extends Controller
{
    use TraitHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultSet = Curso::orderBy('id','DESC')->get();
        return view('curso_list', compact('resultSet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('curso_create');
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
            'nome'         => 'required|min:3|max:255',
            'data_inicio'  => 'required|max:10|min:10'
        ]);

        $dataInicio = $request['data_inicio'];

        if($this->validaDataBrTrait($dataInicio)):
            $insert['nome']        = $request['nome'];
            $insert['data_inicio'] = $this->dataToUsTrait($request['data_inicio']);
            $insert['ativo']       = 1;
            $res = Curso::create($insert);
            if($res):
                //$request->session()->now('status', 'Curso cadastrado com Sucesso!');
                return redirect()->route('curso_list')->with('status', 'Curso cadastrado com Sucesso!');
            endif;
        endif;

        //$request->session()->now('status', 'Erro ao cadastrar Curso');
        return redirect()->route('curso_list')->with('status', 'Erro ao cadastrar Curso');
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
    public function edit(int $id)
    {
        //
        $result = Curso::findOrFail($id);
        return view('curso_edit', compact('result'));
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
            'nome'         => 'required|min:3|max:255',
            'data_inicio'  => 'required|max:10|min:10',
            'id'           => 'required|max:11|integer',
            'ativo'        => 'required|max:1'
        ]);

        //echo "Entrei";
        
        if(!$this->validaDataBrTrait($request['data_inicio'])):
            return redirect()->route('curso_list')->with('status', 'Data inválida.');
        endif;

        $vet['nome']   = $request['nome'];
        $vet['ativo']  = $request['ativo'];
        $vet['data_inicio'] = $this->dataToUsTrait($request['data_inicio']);

        $curso = Curso::findOrFail($request['id']);
        $curso->nome = $vet['nome'];
        $curso->data_inicio = $vet['data_inicio'];
        $curso->ativo = $vet['ativo'];

        $curso->save();

        return redirect()->route('curso_list')->with('status', 'Editado com Sucesso');
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

    public function ajaxParaAluno(){
        $resultSet = Curso::where('ativo', 1)->orderBy('nome','ASC')->get();
  
        return response()->json($resultSet);
    }

    public function disable(int $id){
        $curso = Curso::findOrFail($id);
        $curso->ativo = 0;
        $curso->save();

        return redirect()->route('curso_list')->with('status', 'Curso desabilitado com Sucesso!!!');
    }
}
