<?php

namespace App\Domain\Geral\Configuracao\Repositories;


use App\Domain\Geral\Configuracao\Contracts\ConfiguracaoRepositoryInterface;
use App\Domain\Geral\Configuracao\Models\Configuracao;

class ConfiguracaoRepository implements ConfiguracaoRepositoryInterface
{

    public function retornaValor(string $chave)
    {
        $configuracao = Configuracao::where(Configuracao::CHAVE, $chave)->first();
        return $configuracao?->valor;
    }
}
