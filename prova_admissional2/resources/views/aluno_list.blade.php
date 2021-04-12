@extends('template.template')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listagem de Alunos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Alunos Listagem</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
      @if(session('status'))
        <div class="alert alert-warning">{{session('status')}}</div>
      @endif
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
        <div class="card-body p-2 mt-3">
          <table class="table table-striped table-bordered table-hover projects" id="dataTables-example">
              <thead>
                  <tr>
                      <th style="width: 10%">
                          #ID ALUNO
                      </th>
                      <th style="width: 15%">
                          NOME ALUNO
                      </th>
                      <th style="width: 25%">
                          #MATRÍCULA EM:
                      </th>
                      <th style="width: 15%">
                          DATA DE ADMISSÃO
                      </th>
                      <th style="width:15%">
                          AÇÕES
                      </th>
                  </tr>
              </thead>
              <tbody>
                @if(isset($alunos))
                  @foreach($alunos as $a)
                    @if($a->ativo)
                    <tr>
                        <td>{{$a->id}}</td>
                        <td>{{$a->nome}}</td>
                        <td>
                            @foreach($a->getCursos as $curso)
                                {{$curso->nome}}, 
                            @endforeach
                        </td>
                        <td>
                        @if(isset($a->created_at))
                        {{Helper::dataHoraToBr($a->created_at)}}
                        @endif
                        </td>
                        <td>
                            <a href="{{route('aluno_edit', $a->id)}}" class="btn btn-warning btn-sm">Editar</a>
                            &nbsp;&nbsp;
                            <a href="{{route('aluno_disable', $a->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Confirma desativar este Aluno?');">Desativar</a>
                        </td>
                    </tr>
                    @endif
                  @endforeach
                @endif
              </tbody>
              <tfoot></tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection