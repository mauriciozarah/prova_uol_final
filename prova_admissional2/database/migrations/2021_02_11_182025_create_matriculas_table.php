<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('curso_id')->unsigned();
            $table->bigInteger('aluno_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->boolean('ativo');
            $table->datetime('data_admissao')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}
