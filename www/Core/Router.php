<?php

namespace App\Core;

use App\Core\Security;
use App\Core\Error;

class Router
{
    private $routes;
    private $isInstalling;

    public function __construct($routes, $isInstalling = false)
    {
        $this->routes = $routes;
        $this->isInstalling = $isInstalling;
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
            $uri = "login";
        }
    
       /*  if (empty($this->routes[$uri])) {
            die("Cette route n'existe pas dans le fichier de routing");
        } */
        if (empty($this->routes[$uri])) {
            // Vérification du slug
            $foundRoute = false;
            //ici il parcours et verifie si il y a un slug dans les routes du type /{slug} donc ça peut etre
            // /article/{slug} ou /category/{slug} ou /user/{slug} ou /comment/{slug}
            //si il y a un slug il le remplace par (.+) qui est une expression régulière qui veut dire n'importe quel caractère
            //et si il trouve une route qui correspond à l'uri il la stocke dans $uri et dans $_GET['slug'] le slug
            foreach ($this->routes as $route => $params) {
                if(strpos($route, '/{slug}') !== false){
                    $pattern = str_replace('{slug}', '(.+)', $route);
                    if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                        $uri = $route;
                        $_GET['slug'] = $matches[1]; 
                        $foundRoute = true;
                        break;
                    }
                }
            }
            
            // Si aucune route spécifique pour les articles n'a été trouvée, vérifier les routes génériques
            if (!$foundRoute && empty($this->routes[$uri])) {
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
            }
            

            if (!$foundRoute) {

               // die("Cette route n'existe pas dans le fichier de routing");
                //$error = new Error();
                //$error->setCode(404);
                //$error->addError("Page introuvable");
                $error = new Error();
                $error->setCode(404);
                $view = new View("Auth/404" , "error" );
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
        $apiVerifConnexion = $this->routes[$uri]["apiVerifConnexion"] ?? null;
        $editor = $this->routes[$uri]["editor"]?? null;
        $methods = $this->routes[$uri]["methods"]?? null;

      

        if(!$this->isInstalling){
            if($editor !== null && $editor === false  &&  Security::editor() ){
                header("Location: /admin/");
                exit();
            }

            if ($security !== null && !Security::checkSecurity($security)) {
                 //header("Location: /error");
                  $error = new Error();
                  $error->setCode(404);
                  $view = new View("Auth/404" , "error" );
                  exit();
            }

            if ($verifConnexion !== null && $verifConnexion === true && !Security::checkToken()) {
                session_destroy();
                header("Location: /login");
                exit();
            }
        }

        $controllerFilePath = "Controllers/" . $controller . ".php";
        $controllerFilePath = str_replace('\\', '/', $controllerFilePath);
        if (!file_exists($controllerFilePath)) {
            die("Le fichier " . $controllerFilePath . " n'existe pas");
        }

        include_once $controllerFilePath;

        $controller = "\\App\\Controllers\\" . $controller;
        if (!class_exists($controller)) {
            die("La classe " . $controller . " n'existe pas");
        }

        $objController = new $controller();
        if (!method_exists($objController, $action)) {
            die("L'action " . $action . " n'existe pas");
        }

        if($methods !== null){
            $objController->setAllowedMethods($methods);
        }

        $objController->$action();
    }
}
