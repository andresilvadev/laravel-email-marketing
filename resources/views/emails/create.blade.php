@extends('layouts.app')

@section('content')
<h2>Criar novo e-mail:</h2>
<hr>

@if ($errors->any())
	<div class="alert alert-danger">
		<strong>Whoops!</strong> Houve alguns problemas com seu cadastro de e-mail.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<form action="{{ url('/emails') }}" method="POST" enctype="multipart/form-data">
 	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<label for="name">Nome:</label>
				<input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" >
			</div>
			<div class="form-group {{ $errors->has('subject') ? 'is-invalid' : '' }}">
				<label for="subject">Assunto:</label>
				<input type="text" class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject" >
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="file">Imagem de anexo</label>
		<input type="file" class="form-control-file {{ $errors->has('image') ? 'is-invalid' : '' }}" id="file" name="image" value="{{ old('image') }}">
	</div>

	<div class="input-group">
		<label for="name">Corpo da mensagem:</label>
		<textarea class="form-control" id="summernote" name="body"></textarea>
	</div>

	<br>
	<button class='btn btn-primary btn-lg'>Cadastrar e-mail</button>
	<br>
</form>
@stop