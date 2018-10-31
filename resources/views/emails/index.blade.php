@extends('layouts.app')

@section('content')
	<h2>Listagem de e-mails:</h2>
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
	<a href="{{ url('emails/create') }}" class="btn btn-primary float-right">Cadastrar novo e-mail</a>
	</div>
	<br>

	@if (count($emails) == 0)
		<div class="alert alert-info alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			Nenhum e-mail cadastrado até o momento...
		</div>
	@endif

	<div class="grid">
		<div class="list-group">
			@foreach($emails as $email)
			<a href="{{ route('emails.show', $email->id) }}" class="list-group-item list-group-item-action">{{ $email->name }}</a>
			@endforeach
		</div>
	</div>
@stop