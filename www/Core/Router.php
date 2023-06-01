<?php

namespace App\Core;

use App\Core\Security;

class Router
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function handleRequest($uri)
    {
        $uriExploded = explode("?", $uri);
        $uri = strtolower(trim($uriExploded[0], "/"));

        if (empty($uri)) {
            $uri = "default";
        }

        if (empty($this->routes[$uri])) {
            die("Page 404");
        }

        if (empty($this->routes[$uri]["controller"]) || empty($this->routes[$uri]["action"])) {
            die("Cette route ne possède pas de controller ou d'action dans le fichier de routing");
        }

        $controller = $this->routes[$uri]["controller"];
        $action = $this->routes[$uri]["action"];
        $security = $this->routes[$uri]["security"] ?? null;
         
        if ($security !== null && !Security::checkSecurity($security)) {
            header("Location: /login");
            exit();
        }



        $controllerFilePath = "Controllers/" . $controller . ".php";
        if (!file_exists($controllerFilePath)) {
            die("Le fichier " . $controllerFilePath . " n'existe pas");
        }

        include $controllerFilePath;

        $controller = "\\App\\Controllers\\" . $controller;
        if (!class_exists($controller)) {
            die("La classe " . $controller . " n'existe pas");
        }

        $objController = new $controller();
        if (!method_exists($objController, $action)) {
            die("L'action " . $action . " n'existe pas");
        }

        $objController->$action();
    }
}
