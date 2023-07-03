<?php

namespace App\Core;

use App\Core\Security;
use App\Core\Error;

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

        $explodedUri = explode("/", $uri);
        $slug = isset($explodedUri[1]) ? $explodedUri[1] : null;
        
      /*   //redirection pour l'accès à l'api
        if ($explodedUri[0] === "api") {
            $controller = "ApiController";
            $action = "index";
            $controllerFilePath = "Controllers/" . $controller . ".php";
            require_once($controllerFilePath);
            $controller = new $controller();
            $controller->$action();
            exit();
        }  */

        if (empty($uri)) {
            $uri = "default";
        }
    
       /*  if (empty($this->routes[$uri])) {
            die("Cette route n'existe pas dans le fichier de routing");
        } */
        if (empty($this->routes[$uri])) {
            // Vérification du slug
            $foundRoute = false;
        
            foreach ($this->routes as $route => $params) {
                if (strpos($route, '{slug}') !== false) {
                    $pattern = str_replace('{slug}', '(.+)', $route);
                    if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                        $uri = $route;
                        $_GET['slug'] = $matches[1]; 
                        $foundRoute = true;
                        break;
                    }
                }
            }

            if (!$foundRoute) {

               // die("Cette route n'existe pas dans le fichier de routing");
                //$error = new Error();
                //$error->setCode(404);
                //$error->addError("Page introuvable");
                header("Location: /error");
                exit();
            }
        }

        if (empty($this->routes[$uri]["controller"]) || empty($this->routes[$uri]["action"])) {
            die("Cette route ne possède pas de controller ou d'action dans le fichier de routing");
        }

        $controller = $this->routes[$uri]["controller"];
        $action = $this->routes[$uri]["action"];
        $security = $this->routes[$uri]["security"] ?? null;
        $verifConnexion = $this->routes[$uri]["verifConnexion"] ?? null;
        $editor = $this->routes[$uri]["editor"]?? null;


        /* if ($editor === null && $explodedUri[0] === "admin" && Security::editor()){
            var_dump("tez");die;
            header("Location: /admin/");
            exit();
        } */ //by default editor has all acces
        if($editor !== null && $editor === false  &&  Security::editor() ){
            header("Location: /admin/");
            exit();
        }
         
        if ($security !== null && !Security::checkSecurity($security)) {
            header("Location: /error");
            exit();
        }

        if ($verifConnexion !== null && $verifConnexion === true && !Security::checkToken()) {
            header("Location: /login");
            exit();
        }

       

        $controllerFilePath = "Controllers/" . $controller . ".php";
        $controllerFilePath = str_replace('\\', '/', $controllerFilePath);
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
