@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Informações do cliente
				</div>
				<div class="card-body">
					<h5 class="card-title">{{ $cliente->name }}</h5>
					<p class="card-text">Empresa: {{ $cliente->company }}</p>
					<p class="card-text">E-mail: {{ $cliente->email }}</p>
					<p class="card-text">Criado em: {{ $cliente->created_at->format("d-m-Y") }} às {{ $cliente->created_at->format("h:m:s") }}</p>

					<hr>

						<form class="float-right" action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">

							<a class="btn btn-success" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>

							@csrf
							@method('DELETE')

							<button type="submit" class="btn btn-danger">Deletar</button>
						</form>

				</div>
			</div>
		</div>
	</div>

@stop