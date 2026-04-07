<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/login', ['controller' => 'Login', 'action' => 'login']);
        $builder->connect('/logout', ['controller' => 'Login', 'action' => 'logout']);

        $builder->connect('/', ['controller' => 'Login', 'action' => 'index']);

        $builder->connect('/pages/*', 'Pages::display');

        $builder->fallbacks();
    });

    $routes->prefix('api', function (RouteBuilder $routes): void {
        $routes->fallbacks();
    });
};
