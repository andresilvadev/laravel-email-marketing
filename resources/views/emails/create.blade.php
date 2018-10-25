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

<form action="{{ url('/emails') }}" method="POST">
 	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<label for="name">Nome:</label>
				<input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" >
			</div>
			<div class="form-group {{ $errors->has('subject') ? 'is-invalid' : '' }}">
				<label for="subject">Assunto:</label>
				<input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="subject" >
			</div>
		</div>
	</div>

	<div class="input-group">
		{{--<textarea class="form-control" id="summernote" name="body"></textarea>--}}
		<textarea class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="summernote" name="body"></textarea>
	</div>

	<br>
	<button class='btn btn-primary btn-lg'>Cadastrar e-mail</button>
</form>
@stop