@extends('layouts.app')

@section('content')
	<h3>Editando E-mail: {{ $email->name }}</h3>
	<hr>

	@if ($errors->any())
		<div class="alert alert-danger">
			<strong>Whoops!</strong> Houve alguns problemas com sua atualização de e-mail.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="clearfix">
	<a class="float-right btn btn-secondary" href="{{ url('/emails') }}">Voltar para listagem</a>
	</div>

	<form action="{{ url('/emails/'. $email->id) }}" method="POST">
		{{ method_field('PUT') }}
	 	{{ csrf_field() }}

		<div class="row">
			<div class="col-md-5 col-md-offset-3">
				<div class="form-group">
					<label for="name">Nome:</label>
					<input type="text" class="form-control" name="name" value="{{ $email->name }}" >
				</div>
				<div class="form-group">
					<label for="subject">Assunto:</label>
					<input type="text" class="form-control" name="subject" value="{{ $email->subject }}" >
				</div>
			</div>
		</div>

		<br>
		<div class="input-group">
			<textarea class="form-control" id="summernote" name="body"  value="{{ $email->body }}" required>{!! $email->body !!}</textarea>
		</div>
		<br>

		<div class="text-center">
			<img src="{{ asset('uploads/email_images/'. $email->image )}}" class="rounded img-thumbnail" width="auto" alt="...">
		</div>

		<br>
		<button type='submit' class='btn btn-primary btn-lg'>Atualizar e-mail</button>
		<br>
	</form>
@stop