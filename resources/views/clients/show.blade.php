@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Informações do cliente
				</div>
				<div class="card-body">
					<h5 class="card-title">{{ $client->name }}</h5>
					<p class="card-text">Empresa: {{ $client->company }}</p>
					<p class="card-text">E-mail: {{ $client->email }}</p>
					<p class="card-text">Criado em: {{ $client->created_at->format("d-m-Y") }} às {{ $client->created_at->format("h:m:s") }}</p>

					<hr>

						<form class="float-right" action="{{ route('clients.destroy',$client->id) }}" method="POST">

							<a class="btn btn-success" href="{{ route('clients.edit',$client->id) }}">Editar</a>

							@csrf
							@method('DELETE')

							<button type="submit" class="btn btn-danger">Deletar</button>
						</form>

				</div>
			</div>
		</div>
	</div>

@stop