<?php

use Illuminate\Foundation\Configuration\Middleware;

return function (\Illuminate\Routing\Router $router, Middleware $middleware) {
    $router->middlewareGroup('web', $middleware->getWebMiddleware());
    $router->middlewareGroup('api', $middleware->getApiMiddleware());
    
    collect($middleware->getAliases())->each(function ($middleware, $alias) use ($router) {
        $router->aliasMiddleware($alias, $middleware);
    });
    
    return $router;
}; 