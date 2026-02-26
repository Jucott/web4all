<?php

class Router
{
    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');

        $segments = explode('/', $uri);

        /*
        /entreprise/show/12
        [0] => entreprise
        [1] => show
        [2] => 12
        */

        $controllerSegment = $segments[0] ?? 'entreprise';
        $method = $segments[1] ?? 'recherche';
        $param = $segments[2] ?? null;

        $controllerName = ucfirst($controllerSegment) . 'Controller';

        if (!class_exists($controllerName)) {
            http_response_code(404);
            die("Controller $controllerName not found");
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            http_response_code(404);
            die("Method $method not found");
        }

        // Appel dynamique avec ou sans paramètre
        if ($param !== null) {
            $controller->$method($param);
        } else {
            $controller->$method();
        }
    }
}
