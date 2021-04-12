@extends('template.template')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastrar Curso</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Curso Cadastrar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Preencha os dados:</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
            <form name="formulario" action="{{route('curso_add_exe')}}" method="POST" class="form-horizontal" onsubmit="return validaData(document.formulario.data_inicio.value) && validaForm();">
                @csrf
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nome">Nome do Curso</label>
                    <input type="text" name="nome" id="nome" value="{{old('nome')}}" class="form-control" required="required" maxlength="255">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="dt_inicio">Data de Início</label>
                    <input type="text" name="data_inicio" id="dt_inicio" value="{{old('data_inicio')}}" class="form-control datepicker" required="required" maxlength="20">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                  </div>
                </div>               
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    <script>
      function validaForm(){
        if(document.formulario.nome.value == ""){
          alert("Nome é obrigatório");
          return false;
        }
        return true;
      }
    </script>
@endsection