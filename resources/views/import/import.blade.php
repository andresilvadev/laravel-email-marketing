@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Houve alguns problemas com a leitura dos arquivos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Importação de clientes:</h2>
    <hr>

    <form method="POST" action="{{ route('import_parse') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
            <label for="csv_file" class="col-md-4 control-label">Seleciono o arquivo CSV</label>

            <div class="col-md-6">
                <input id="csv_file" type="file" class="form-control-file" name="csv_file">
            </div>
        </div>

        {{--
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="header"> O arquivo contém cabeçalho?
                    </label>
                </div>
            </div>
        </div>
        --}}

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Ler dados do arquivo
                </button>
            </div>
        </div>
    </form>


@endsection