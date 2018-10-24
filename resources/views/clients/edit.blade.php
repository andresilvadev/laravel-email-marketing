@extends('layouts.app')

@section('content')
<h1>Editando cliente: {{ $client->name }}</h1>
<hr>
<div class="row">
	<div class="col-md-offset-3 col-md-6">

		<form action="{{ url('/clients/'.$client->id) }}" method="POST">
			{{ method_field('PUT') }}
			{{ csrf_field() }}
			<div class='form-group'>
				<label for='name'>Nome:</label>
				<input type='text' class='form-control' name='name' value="{{ $client->name }}">
			</div>
			<div class='form-group'>
				<label for='last_name'>Sobre-nome:</label>
				<input type='text' class='form-control' name='last_name' value="{{ $client->last_name }}">
			</div>
			<div class='form-group'>
				<label for='email'>E-mail:</label>
				<input type='email' class='form-control' name='email' required value="{{ $client->email }}">
			</div>
			<div class='form-group'>
				<label for='company'>Empresa:</label>
				<input type='text' class='form-control' name='company' required value="{{ $client->company }}">
			</div>
			<div class='form-group'>
				<label for='group'>Grupo:</label><br>
				<select class="selectpicker form-control" name="group" data-live-search="true">
					@foreach($groups as $group)
						<option value="{{ $group->id }}"
									data-tokens="{{ $group->name }}" 
									{{ ($client->group->id == $group->id) ? 'selected':''}}>{{ $group->name }}
						</option>
					@endforeach
				</select>
			</div>

			<button type='submit' class='btn btn-primary btn-lg'>Atualizar cliente</button>
			<a class="btn btn-secondary btn-lg" href="{{ url('/clients/'.$client->id) }}">Mostrar cliente</a>
		</form>

	</div>
</div>
@stop
