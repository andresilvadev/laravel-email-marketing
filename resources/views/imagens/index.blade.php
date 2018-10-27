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
	<div class="col-md-3 col-lg-3" style="margin-bottom: 20px">
		<div class="card">
			<img class="card-img-top"
				 src="{{ asset('uploads/imagens/'. $image->url )}}"
				 alt="{{$image->title}}" width="100%" height="220px"/>
			<div class="card-body">
				<h6 class="card-title text-center">{{ $image->title }}</h6>
				<div class="text-center">
					<span class="badge badge-primary">Cód: {{ $image->id }}</span>
				</div>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<form id="frm_{{ $image->id }}" action="{{ route('imagens.destroy', $image->id) }}"
						  method="post" style="padding-bottom: 0px;margin-bottom: 0px">
						<div class="row">
							<div class="col-sm-12">
								<a href="javascript:if(confirm('Deseja realmente excluir esta imagem?')) $('#frm_{{$image->id}}').submit()" class="btn btn-danger btn-sm btn-block">Deletar</a>
							</div>
							<input type="hidden" name="_method" value="delete"/>
							{{csrf_field()}}
						</div>
					</form>
				</li>
			</ul>
		</div>
	</div>

	@endforeach
	</div>
	<div>
		{{ $images->links() }}
	</div>

@stop