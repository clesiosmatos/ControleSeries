<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie, 
        int $qtdTemporadas,
        int $epPorTemporada
    ): Serie {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criarTemporadas($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();
        
        return $serie;
    }

    private function criarTemporadas(int $qtdTemporadas, int $epPorTemporada, $serie): void
    {
        for($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($epPorTemporada, $temporada);
            
        }
    }

    private function criarEpisodios(int $epPorTemporada, $temporada): void
    {
        for($j = 1; $j <= $epPorTemporada; $j++){
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}