<?php

use Illuminate\Support\Facades\Route;

    function isActive($routes, $output = 'active') {
        if (!is_array($routes)) {
            $routes = [$routes];
        }

        foreach ($routes as $route) {
            if (Route::currentRouteNamed($route)) {
                return $output;
            }
        }

        return '';
    }

