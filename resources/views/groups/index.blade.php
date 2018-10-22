@extends('layouts.app')

@section('content')
	<h2>Listagem de grupos:</h2>
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
		<a href="{{ url('groups/create') }}" class="btn btn-primary float-right">Cadastrar novo grupo</a>
	</div>

	<br>

	<div class="row">
		<div class="col-md-12">
			<table id="groups_table" class="table table-hover table-light">
				<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Num. Clients</th>
					<th width="280px">Ação</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($groups as $group)
					<tr>
						<td>{{ $group->id }}</td>
						<td>{{ $group->name }}</td>
						<td>{{ $group->number_of_clients() }}</td>
						<td><a href="{{ url('groups/' . $group->id ) }}" class="btn btn-primary">Vizualizar</a></td>
					</tr>
				@endforeach
				</tbody>
			</table>

			{{--{!! $groups->links() !!}--}}

		</div>

	</div>
@stop