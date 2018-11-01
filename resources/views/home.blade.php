@extends('layouts.app')

@section('content')

    <div class="row mt-4">
        <div class="col-lg-3 col-md-6">
            <div class="card text-center">
                <div class="card-header bg-success text-white">
                    Clientes
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total de clientes cadastrados</h5>
                    <p class="card-text">{{ count($clientes) }}</p>
                    <a href="{{route('clients.index')}}" class="btn btn-success">Ver clientes</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-center">
                <div class="card-header bg-secondary text-white">
                    E-mails
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total de campanhas de e-mails</h5>
                    <p class="card-text">{{ count($emails) }}</p>
                    <a href="{{route('emails.index')}}" class="btn btn-secondary">Ver e-mails</a>
                </div>
            </div>
        </div>

    </div>

@endsection
