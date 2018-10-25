@extends('layouts.app')

@section('content')
<h2>Listagem de clientes:</h2>
<hr>

@if ($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
@endif

@if ($message = Session::get('fail'))
	<div class="alert alert-danger">
		<p>{{ $message }}</p>
	</div>
@endif

<div class="clearfix">
	<a href="{{ url('clients/create') }}" class="btn btn-primary float-right">Cadastrar novo cliente</a>
</div>

<br>

<div class="clearfix">
	<table id="clients_table" class="table table-hover table-light">
		<thead>
            <tr>
                <th>Cod</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Empresa</th>
				<th width="220px" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
			@foreach ($clients as $client)
				<tr>
					<td>{{ $client->id }}</td>
					<td>{{ $client->name }}</td>
					<td>{{ $client->email }}</td>
					<td>{{ $client->company }}</td>
					<td>
						<form action="{{ route('clients.destroy',$client->id) }}" method="POST">

							<a class="btn btn-secondary" href="{{ route('clients.show',$client->id) }}">Visualizar</a>

							<a class="btn btn-success" href="{{ route('clients.edit',$client->id) }}">Editar</a>

							@csrf
							@method('DELETE')

							<button type="submit" class="btn btn-danger">Deletar</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{!! $clients->links() !!}
</div>
@stop