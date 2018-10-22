@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Informações do cliente
				</div>
				<div class="card-body">
					<h5 class="card-title">{{ $client->name.' '.$client->last_name }}</h5>
					<p class="card-text">Empresa: {{ $client->company }}</p>
					<p class="card-text">E-mail: {{ $client->email }}</p>
					<p class="card-text">Criado em:: {{ $client->created_at }}</p>
					<p class="card-text">Transações: {{ $client->transactions->count()  }}</p>
					<p class="card-text">Grupo: {{ $client->group->name }}</p>

					<a class="float-right btn btn-danger ml-2" data-method="delete" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" href="{{ url('/clients/'.$client->id) }}">Deletar cliente</a>
					<a class="float-right btn btn-success" href="{{ url('/clients/'.$client->id.'/edit') }}">Edita cliente</a>
				</div>
			</div>
		</div>
	</div>

@stop