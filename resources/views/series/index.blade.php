@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')
@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif
<a href="{{ route('series.criar') }}" class="btn btn-dark mb-3">Adicionar</a>

<ul class="list-group">
    @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $serie->nome }}

            <span class="d-flex">
                <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                <form method="POST" action="/series/{{$serie->id}}"
                    onsubmit="return confirm('Tem certeza que deseja deletar a série {{ addslashes($serie->nome) }}?')">
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </form>
            </span>
        </li>
    @endforeach
</ul>
@endsection