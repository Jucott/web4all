<?php

class Router
{
    public function dispatch()
    {
        
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');

        // Gestion explicite de la racine du site
        if ($uri === '') {
            $controllerSegment = 'home';
            $method = 'index';
            $param = null;
        } else {

            $segments = explode('/', $uri);

            /*
            /entreprise/show/12
            [0] => entreprise
            [1] => show
            [2] => 12
            */

            $controllerSegment = $segments[0] ?? 'home';
            $method = $segments[1] ?? 'index';
            $param = $segments[2] ?? null;
        }

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
        /*
        Génération de la permission automatiquement
        exemple : entreprise_create
        */
        $permission = strtolower($controllerSegment . '_' . $method);
        $this->registerPermission($permission);

        $this->checkAccess($permission);
        // Appel dynamique avec ou sans paramètre
        if ($param !== null) {
            $controller->$method($param);
        } else {
            $controller->$method();
        }
    }


    private function checkAccess($permission)
    {
        $roleId = Auth::roleId();
        
        if (!Auth::can($permission, $roleId)) {

            if (!Auth::check()) {
                header('Location: /auth/login');
                exit;
            }

            http_response_code(403);
            die("Accès interdit");
        }
        return true;
    }


    private function registerPermission($permission)
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("
            INSERT INTO page_fonction(permission)
            VALUES(:perm)
            ON CONFLICT DO NOTHING
        ");

        $stmt->execute(['perm' => $permission]);
    }

}
