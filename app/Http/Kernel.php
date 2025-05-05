<?php

namespace App\Http;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Os middlewares globais HTTP da aplicação.
     *
     * São executados em **todas** as requisições.
     */
    protected function globalMiddleware(): array
    {
        return [
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
            \Illuminate\Http\Middleware\HandleCors::class,
        ];
    }

    /**
     * Os grupos de middleware.
     *
     * Ex: "web" e "api".
     */
    protected function middlewareGroups(): array
    {
        return [
            'web' => [
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            ],

            'api' => [
                // throttle pode ser ativado se quiser
                // \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],
        ];
    }

    /**
     * Middlewares individuais que podem ser usados por nome nas rotas.
     */
    protected function routeMiddleware(): array
    {
        return [
            'auth' => \App\Http\Middleware\Authenticate::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ];
    }
}
