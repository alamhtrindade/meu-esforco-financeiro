<?php

namespace App\Domain\Base\Providers;

use Illuminate\Support\ServiceProvider;

class AbstractServiceProvider extends ServiceProvider
{
   
    public function bind(
        mixed $abstractServiceClass,
        mixed $concreteServiceClass,
    ): void
    {
        $this->app->bind(
            $abstractServiceClass,
            function() use ($concreteServiceClass) {
                return $this->app->make($concreteServiceClass);
            }
        );
    }
}