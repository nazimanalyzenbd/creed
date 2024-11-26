<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        // Register middleware aliases
        $router->aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);
        $router->aliasMiddleware('role', \Spatie\Permission\Middlewares\RoleMiddleware::class);
    }
}
