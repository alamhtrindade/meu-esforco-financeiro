<?php

namespace App\Domain\Geral\Configuracao\Providers;

use Illuminate\Support\ServiceProvider;

class ConfiguracaoProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Domain\Geral\Configuracao\Contracts\ConfiguracaoRepositoryInterface',
            'App\Domain\Geral\Configuracao\Repositories\ConfiguracaoRepository'
        );
    }
}
