@extends('layouts.app')

@section('content')
 <h3>Edit group:</h3>
 <hr>
<form action="{{ url('/groups/'.$group->id) }}" method="POST">
	{{ method_field('PUT') }}
 	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="form-group">
				<label for="name">Group name:</label>
				<input type="text" name="name" class="form-control" value="{{ $group->name }}">
			</div>
		</div>
	</div>
	<div class="clearfix">
		<a class="float-right btn btn-primary"
	    	href="{{ url('/groups/'.$group->id) }}">Visualizar grupo</a>
	</div>
	<br>
	<div class="clearfix">
		<h4>Clique no cliente para remove-lo do grupo:</h4>
		<hr>
		<table id="group_clients_table" class="table table-hover table-light">
			<thead>
		        <tr>
		            <th>#</th>
					<th>Empresa</th>
					<th>E-mail</th>
					<th>Nome completo</th>
					<th>Ações</th>
		        </tr>
		    </thead>
		    <tbody>
				@foreach ($group->clients as $client)
					<tr>
						<td>{{ $client->id }}</td>
						<td>{{ $client->company }}</td>
						<td>{{ $client->email }}</td>
						<td>{{ $client->name." ".$client->last_name }}</td>
						<td>
							<a href="{{ url('clients/'.$client->id) }}" class="btn btn-primary btn-xs">Mostrar cliente</a>
							<a href="{{ url('groups/'.$group->id.'/client/'.$client->id) }}" class="btn btn-danger btn-xs">Remover do grupo</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<br>
	<button type='submit' class='btn btn-primary btn-lg'>Atualizar grupo</button>
</form>
@stop