@extends('template.template')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastrar Aluno</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Aluno Cadastrar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"></h3>

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
            <form name="formulario" action="{{route('aluno_add_exe')}}" method="POST" class="form-horizontal" onsubmit="return validaFormAluno();">
                @csrf
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nome">Nome do Aluno</label>
                    <input type="text" name="nome" id="nome" value="{{old('nome')}}" class="form-control" required="required" maxlength="255">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" required="required" maxlength="100">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="senha" id="password" value="{{old('password')}}" class="form-control" required="required" maxlength="100">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="passwordc">Confirme a Senha</label>
                    <input type="password" name="senhac" id="passwordc" value="{{old('senhac')}}" class="form-control" required="required" maxlength="100">
                  </div>
                </div>
                <div class="col-md-12">
                    <hr />
                    <h5>Escolha os Cursos abaixo:</h5>
                </div>
                <div class="row">
                    <div class="col-md-10" id="curso0">
                        <div class="form-group">
                            <select name="curso_id[]" class="form-control" id="c0" required="required">
                                <option>Escolha o Curso</option>
                                @foreach($cursos as $c)
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                    <a href="#" class="btn btn-success" onclick="adicionar(event, '{{route('curso_ajax')}}', '{{csrf_token()}}');" title="Adicionar Curso"><span class="fas fa-plus"></span></a>
                    </div>
                </div>

                <span id="span_container"></span>

                <input type="hidden" id="count" value="1">
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
      function validaFormAluno(){
        var nome   = document.formulario.nome.value;
        var email  = document.formulario.email.value;
        var senha  = document.formulario.senha.value;
        var senhac = document.formulario.senhac.value;

        if(nome != "" && email != "" && senha != "" && senhac != "" && (senha == senhac)){
            return true;
        }

        if(senha != senhac){
            alert("Senhas não conferem.");
            return false;
        }

        return false;
      }
    </script>
@endsection