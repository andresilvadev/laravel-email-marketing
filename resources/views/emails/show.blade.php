@extends('layouts.app')

@section('content')
	<h3>Informações de e-mail:</h3>
	<hr>

	<div class="clearfix">

		<form id="frm_{{ $email->id }}" action="{{ route('emails.destroy',$email->id) }}" method="POST">
			@csrf
			@method('DELETE')
			<a href="javascript:if(confirm('Deseja realmente excluír este cliente?')) $('#frm_{{$email->id}}').submit()" class="float-right btn btn-danger ml-2">Deletar e-mail</a>
		</form>

		<a class="float-right btn btn-success ml-2" href="{{ route('emails.edit',$email->id,'/edit') }}">Editar e-mail</a>

		<a class="float-right btn btn-primary ml-2"	href="{{ url('/send_email_all_clients/'.$email->id) }}">Enviar email para todos</a>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class='form-group'>
				<label>Nome:</label>
				<input type='text' class='form-control' value="{{ $email->name }}" disabled>
			</div>
			<div class='form-group'>
				<label>Assunto:</label>
				<input type='text' class='form-control' value="{{ $email->subject }}" disabled>
			</div>
		</div>
	</div>

	<label>Corpo da mensagem:</label>

	<hr>

	<div class="clearfix m-4">
		<div class="panel panel-default">
		    <div class="panel-body">
		    	<div class="mb-5 mt-5">
					{!! $email->body !!}
				</div>
			</div>
		</div>
	</div>

	<div class="text-center">
		<img src="{{ asset('uploads/email_images/'. $email->image )}}" class="rounded img-thumbnail" width="auto" alt="...">
	</div>

	<hr>
@stop