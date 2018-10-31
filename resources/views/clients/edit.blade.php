@extends('layouts.app')

@section('content')
<h1>Editando cliente: {{ $cliente->name }}</h1>
<hr>

@if ($errors->any())
	<div class="alert alert-danger">
		<strong>Whoops!</strong> Houve alguns problemas com sua atualização de cliente.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<div class="row">
	<div class="col-md-offset-3 col-md-6">

		<form action="{{ url('/clientes/'. $cliente->id) }}" method="POST">
			{{ method_field('PUT') }}
			{{ csrf_field() }}

			<div class='form-group'>
				<label for='nome'>Nome:</label>
				<input type='text' class='form-control' name='nome' value="{{ $cliente->nome }}" required>
			</div>
			<div class='form-group'>
				<label for='email'>E-mail:</label>
				<input type='email' class='form-control' name='email'  value="{{ $cliente->email }}" required>
			</div>
			<div class='form-group'>
				<label for='empresa'>Empresa:</label>
				<input type='text' class='form-control' name='empresa'  value="{{ $cliente->empresa }}" required>
			</div>

			<button type='submit' class='btn btn-primary btn-lg'>Atualizar cliente</button>
			<a class="btn btn-secondary btn-lg" href="{{ url('/clientes') }}">Voltar para listagem</a>
		</form>

	</div>
</div>
@stop
