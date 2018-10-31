@extends('layouts.app')

@section('content')
    <h2>Upload de imagens:</h2>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Houve alguns problemas com o upload da imagem.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $message }}
        </div>
    @endif

    <form action="{{ route('imagens.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-offset-3 col-md-6">

                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label for="file">URL</label>
                    <input type="file" class="form-control-file {{ $errors->has('url') ? 'is-invalid' : '' }}" id="file" name="url" value="{{ old('url') }}">
                </div>

                <hr>

                <button type="submit" class="btn btn-primary btn-lg">Enviar imagem</button>
            </div>
        </div>
    </form>
@stop
