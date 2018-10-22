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
                <th>#</th>
				<th>Empresa</th>
				<th>E-mail</th>
				<th>Nome</th>
				<th>Grupo</th>
            </tr>
        </thead>
        <tbody>
			@foreach ($clients as $client)
				<tr>
					<td>{{ $client->id }}</td>
					<td>{{ $client->company }}</td>
					<td>{{ $client->email }}</td>
					<td>{{ $client->name." ".$client->last_name }}</td>
					<td>{{ $client->group->name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{!! $clients->links() !!}
</div>
@stop