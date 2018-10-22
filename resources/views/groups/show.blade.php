@extends('layouts.app')

@section('content')
	<h3>Informações do grupo: {{ $group->name }}</h3>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Group name:</label>
				<input type="text" class="form-control" value="{{ $group->name }}" disabled>
			</div>
		</div>
	</div>

	<div class="clearfix">

		<form action="{{ route('groups.destroy',$group->id) }}" method="POST">
			<a class="float-right btn btn-success m-2" href="{{ route('groups.edit',$group->id) }}">Editar grupo</a>
			@csrf
			@method('DELETE')
			<button type="submit" class="float-right btn btn-danger  m-2">Delete grupo</button>
		</form>

	</div>

	<br>

	<div class="clearfix">
	<h4>Lista de clientes pertencente a este grupo:</h4>
	<hr>
		<table id="clients_table" class="table table-hover table-light">
			<thead>
	            <tr>
	                <th>#</th>
					<th>Nome da empresa</th>
					<th>E-mail</th>
					<th>Nome completo</th>
	            </tr>
	        </thead>
	        <tbody>
				@foreach ($group->clients as $client)
					<tr>
						<td>{{ $client->id }}</td>
						<td>{{ $client->company }}</td>
						<td>{{ $client->email }}</td>
						<td>{{ $client->name." ".$client->last_name }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop