<?php

namespace App\Domain\Geral\Configuracao\Contracts;

interface ConfiguracaoRepositoryInterface
{
    public function retornaValor(string $chave);
}
