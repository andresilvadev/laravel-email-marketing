@extends('layouts.app')

@section('content')
	<h2>Listagem de e-mails:</h2>
	<hr>

	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif

	<div class="clearfix">
	<a href="{{ url('emails/create') }}" class="btn btn-primary float-right">Cadastrar novo e-mail</a>
	</div>
	<br>
	<div class="grid">
		<div class="grid-sizer"></div>
		<ul class="list-group">
		@foreach($emails as $email)
			<li class="list-group-item list-group-item-action">{{ $email->name }}</li>
		@endforeach
		</ul>
	</div>
@stop