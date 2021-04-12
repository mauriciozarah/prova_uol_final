@extends('template.template')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listagem de Matriculas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Matrículas Listagem</li>
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
                          #CURSO:
                      </th>
                      <th style="width: 15%">
                          DATA DE ADMISSÃO
                      </th>
                      <th>
                          MATRICULA ATIVA ?
                      </th>
                      <th style="width:15%">
                          AÇÕES
                      </th>
                  </tr>
              </thead>
              <tbody>
                @if(isset($result))
                  @foreach($result as $r)
                    
                    <tr>
                        <td>{{$r->aluno_id}}</td>
                        <td>{{$r->aluno}}</td>
                        <td>{{$r->curso}}</td>
                        <td>
                        @if(isset($r->data_admissao))
                          {{Helper::dataHoraToBr($r->data_admissao)}}
                        @endif
                        </td>
                        <td>
                          @if($r->matricula_ativa)
                            Ativa
                          @else
                            Inativa
                          @endif
                        </td>
                        <td>
                          <a href="{{route('matricula_enable', [$r->aluno_id, $r->curso_id])}}" class="btn btn-success btn-sm">Ativar</a>&nbsp;&nbsp;
                          <a href="{{route('matricula_disable', [$r->aluno_id, $r->curso_id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Confirma desativar esta Matricula?');">Desativar</a>
                        </td>
                    </tr>
                   
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