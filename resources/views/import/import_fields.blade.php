@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('import_process') }}">
        {{ csrf_field() }}
        <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />

        <table class="table table-hover table-light">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Empresa</th>
                <th>E-mail</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($csv_data as $row)
                <tr>
                    @foreach ($row as $key => $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                @foreach ($csv_data[0] as $key => $value)
                    <td>
                        <select class="form-control" name="fields[{{ $key }}]">
                            @foreach (config('app.db_fields') as $db_field)
                                <option value="{{ (\Request::has('header')) ? $db_field : $loop->index }}"
                                        @if ($key === $db_field) selected @endif>{{ $db_field }}</option>
                            @endforeach
                        </select>


                    </td>
                @endforeach
            </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">
            Importar dados
        </button>
    </form>
@endsection
