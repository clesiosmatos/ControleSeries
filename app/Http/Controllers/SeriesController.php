<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;

class SeriesController extends Controller
{
    public function index(Request $request) 
    {
        $series = Serie::query()
        ->orderBy('nome')
        ->get();

        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(
        SeriesFormRequest $request, 
        CriadorDeSerie $criadorDeSerie
    ) {

        $serie = $criadorDeSerie->criarSerie(
            $request->nome, 
            $request->qtd_temporadas, 
            $request->ep_por_temporada
        );

        $request->session()
        ->flash(
            'mensagem',
            "Série {$serie->id} criada com sucesso {$serie->nome}"
        );

        return redirect()
        ->route('listar.series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()
        ->flash(
            'mensagem',
            "Série $nomeSerie foi removida com sucesso"
        );

        return redirect()
        ->route('listar.series');
    }

}
