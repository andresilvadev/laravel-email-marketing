@extends('layouts.app')

@section('content')
	<h2>Listagem de imagens:</h2>
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
	<a href="{{ url('imagens/create') }}" class="btn btn-primary float-right">Carregar nova imagem</a>
	</div>
	<br>

	<div class="row">
		@foreach($images as $image)
			<div class="col-sm-4">
				<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="{{ asset('uploads/imagens/'. $image->url )}}" alt="{{ $image->title }}" >
					<div class="card-body text-center">
						<h5 class="card-title">{{ $image->title }}</h5>
						<a href="#" class="btn btn-danger">Deletar imagem</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>

@stop