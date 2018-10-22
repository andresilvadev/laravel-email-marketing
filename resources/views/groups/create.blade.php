@extends('layouts.app')

@section('content')
	<h2>Cadastrar novo grupo:</h2>
	<hr>

	@if ($errors->any())
		<div class="alert alert-danger">
			<strong>Whoops!</strong> Houve alguns problemas com seu cadastro do grupo.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<form action="{{ url('/groups') }}" method="POST">
				{{ csrf_field() }}
				<div class='form-group'>
					<label for='name'>Nome do grupo:</label>
					<input type='text' class='form-control {{ $errors->has('name') ? 'is-invalid' : '' }}' name='name' value="{{ old('name') }}">
				</div>
				<hr>
				<button type='submit' class='btn btn-primary btn-lg'>Cadastrar novo grupo</button>
				<a class='btn btn-secondary btn-lg' href="{{ route('groups.index') }}">Voltar para listagem</a>
			</form>
		</div>
	</div>
@stop