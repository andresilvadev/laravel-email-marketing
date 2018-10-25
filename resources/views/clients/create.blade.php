@extends('layouts.app')

@section('content')
	<h2>Cadastrar novo cliente:</h2>
	<hr>

	@if ($errors->any())
		<div class="alert alert-danger">
			<strong>Whoops!</strong> Houve alguns problemas com seu cadastro de cliente.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{ url('/clients') }}" method="POST">
		{{ csrf_field() }}

	<div class="row">
		<div class="col-md-offset-3 col-md-6">

				<div class="form-group">
					<label for="name">Nome:</label>
					<input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}">
				</div>
				<div class="form-group">
					<label for="email">E-mail:</label>
					<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}">
				</div>
				<div class="form-group">
					<label for="company">Empresa:</label>
					<input type="text" class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company" value="{{ old('company') }}">
				</div>
				<hr>
				<button type="submit" class="btn btn-primary btn-lg">Cadatrar novo cliente</button>
				<a class="btn btn-secondary btn-lg" href="{{ route('clients.index') }}">Voltar para listagem</a>

		</div>
	</div>
	</form>
@stop