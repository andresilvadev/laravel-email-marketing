@extends('layouts.app')

@section('content')
<h1>Editando cliente: {{ $cliente->name }}</h1>
<hr>
<div class="row">
	<div class="col-md-offset-3 col-md-6">

		<form action="{{ url('/clientes/'. $cliente->id) }}" method="POST">
			{{ method_field('PUT') }}
			{{ csrf_field() }}
			<div class='form-group'>
				<label for='nome'>Nome:</label>
				<input type='text' class='form-control' name='nome' value="{{ $cliente->nome }}">
			</div>
			<div class='form-group'>
				<label for='email'>E-mail:</label>
				<input type='email' class='form-control' name='email' required value="{{ $cliente->email }}">
			</div>
			<div class='form-group'>
				<label for='empresa'>Empresa:</label>
				<input type='text' class='form-control' name='empresa' required value="{{ $cliente->empresa }}">
			</div>

			<button type='submit' class='btn btn-primary btn-lg'>Atualizar cliente</button>
			<a class="btn btn-secondary btn-lg" href="{{ url('/clientes') }}">Voltar para listagem</a>
		</form>

	</div>
</div>
@stop
