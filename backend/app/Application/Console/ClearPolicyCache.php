<?php

namespace App\Aplicacao\Console;

use App\Aplicacao\Cache\PolicyCache;
use Illuminate\Console\Command;

class ClearPolicyCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ist:clear-policy-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando exclusivo do IST para limpeza do cache de regras de acesso(policy).';

    /**
     * @return void
     */
    public function handle(): void
    {
        PolicyCache::invalidateAllPolicy();

        info('Cache de regras(policy) limpo.');

        echo "Cache de regras(policy) limpo!\n";
    }
}
