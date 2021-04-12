@extends('template.template')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listagem de Cursos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Cursos Listagem</li>
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
                          #ID CURSO
                      </th>
                      <th style="width: 15%">
                          NOME DO CURSO
                      </th>
                      <th style="width: 15%">
                          DATA INICIO
                      </th>
                      <th style="width:10%">
                        ATIVO
                      </th>
                      <th style="width: 15%">
                          AÇÕES
                      </th>
                  </tr>
              </thead>
              <tbody>
                @if(isset($resultSet))
                  @foreach($resultSet as $r)
                    <tr>
                        <td>{{$r->id}}</td>
                        <td>{{$r->nome}}</td>
                        <td>{{Helper::dataHoraToBr($r->data_inicio)}}</td>
                        <td>
                          @if($r->ativo)
                            Ativo
                          @else 
                            Inativo
                          @endif
                        </td>
                        <td>
                            <a href="{{route('curso_edit', $r->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>
                            &nbsp;&nbsp;
                            <a href="{{route('curso_disable', $r->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-pencil"></i> Desabilitar</a>
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