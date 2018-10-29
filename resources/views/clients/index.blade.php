@extends('layouts.app')

@section('content')
<h2>Listagem de clientes:</h2>
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
	<a href="{{ url('import') }}" class="btn btn-secondary float-right ml-2">Importar clientes CSV</a>
	<a href="{{ url('clients/create') }}" class="btn btn-primary float-right">Cadastrar novo cliente</a>
</div>

<br>

<div class="clearfix">
	<div class="table-responsive-sm">
	<table id="clients_table" class="table table-hover table-light">
		<thead>
            <tr>
                <th>Cod</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Empresa</th>
				<th width="220px" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
			@foreach ($clients as $client)
				<tr>
					<td>{{ $client->id }}</td>
					<td>{{ $client->nome }}</td>
					<td>{{ $client->email }}</td>
					<td>{{ $client->empresa }}</td>
					<td>
						<form id="frm_{{ $client->id }}" action="{{ route('clients.destroy',$client->id) }}" method="POST">
							<div class="row">
								<div class="col-sm-12 col-md-4">
									<a class="btn btn-secondary btn-sm btn-block" href="{{ route('clients.show',$client->id) }}">Mostrar</a>
								</div>
								<div class="col-sm-12 col-md-4">
									<a class="btn btn-success btn-sm btn-block" href="{{ route('clients.edit',$client->id) }}">Editar</a>
								</div>

								@csrf
								@method('DELETE')

								<div class="col-sm-12 col-md-4">
									<a href="javascript:if(confirm('Deseja realmente excluír este cliente?')) $('#frm_{{$client->id}}').submit()" class="btn btn-danger btn-sm btn-block">Deletar</a>
								</div>
							</div>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>

	{!! $clients->links() !!}
</div>
@stop