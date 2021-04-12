<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'CursoController@index')->name('home');


Route::prefix('alunos')->group(function(){
    Route::get('/listar', 'AlunoController@index')->name('aluno_list');
    Route::get('/cadastrar', 'AlunoController@create')->name('aluno_add');
    Route::get('/editar/{id}', 'AlunoController@edit')->name('aluno_edit');
    Route::post('/cadastrar_exe', 'AlunoController@store')->name('aluno_add_exe');
    Route::put('/editar_exe', 'AlunoController@update')->name('aluno_edit_exe');
    Route::get('/disable/{id}', 'AlunoController@disable')->name('aluno_disable');
});

Route::prefix('cursos')->group(function(){
    Route::get('/listar', 'CursoController@index')->name('curso_list');
    Route::get('/cadastrar', 'CursoController@create')->name('curso_add');
    Route::get('/editar/{id}', 'CursoController@edit')->name('curso_edit');
    Route::post('/cadastrar_exe', 'CursoController@store')->name('curso_add_exe');
    Route::put('/editar_exe', 'CursoController@update')->name('curso_edit_exe');
    Route::post('/ajaxAlunos', 'CursoController@ajaxParaAluno')->name('curso_ajax');
    Route::get('/disable/{id}', 'CursoController@disable')->name('curso_disable');
});

Route::prefix('matriculas')->group(function(){
    Route::get('/list', 'MatriculaController@index')->name('matricula_list');
    Route::get('/disable/{aluno_id}/{curso_id}', 'MatriculaController@disable')->name('matricula_disable');
    Route::get('/enable/{aluno_id}/{curso_id}', 'MatriculaController@enable')->name('matricula_enable');
});

