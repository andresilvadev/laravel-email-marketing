@extends('layouts.app')

@section('content')

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

    <form action="{{ url('/send_email_all_clients') }}" method="GET">
        {{ csrf_field() }}
        <div class="jumbotron">
            <h1 class="display-4">E-mail marketing!</h1>
            <p class="lead m-1">Para enviar e-mails para todos os clientes cadastrado basta apenas clicar no botão enviar campanha.</p>
            <hr class="my-4">
            <p class="lead m-1">Ou se achar necessário criar uma nova campanha sinta-se a vontade.</p><br>

            <div class="clearfix">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-lg"> Enviar campanha</button>
                    <a class="btn btn-success btn-lg" href="#" role="button"> Nova campanha</a>
                </div>
            </div>

        </div>
    </form>

@endsection
