<?php

namespace App;

use PDO;

//require "Core/View.php";

spl_autoload_register(function ($class) {

    //$class = App\Core\View
    $class = str_replace("App\\","", $class);
    //$class = Core\View
    $class = str_replace("\\","/", $class);
    //$class = Core/View
    $class = $class.".php";
    //$class = Core/View.php
    if(file_exists($class)){
        include $class;
    }
});




//Afficher le controller et l'action correspondant à l'URI

$uri = $_SERVER["REQUEST_URI"];
$uriExploded = explode("?", $uri);
$uri = strtolower(trim( $uriExploded[0], "/"));

if(empty($uri)){
    $uri = "default";
}

if(!file_exists("routes.yml")){
    die("Le fichier routes.yml n'existe pas");
}

$routes = yaml_parse_file("routes.yml");

if(empty($routes[$uri])){
    die("Page 404");
}

if(empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"]) ){
    die("Cette route ne possède pas de controller ou d'action dans le fichier de routing");
}

$controller = $routes[$uri]["controller"];
$action = $routes[$uri]["action"];


// $controller => Auth ou Main
// $action=> home ou login


if(!file_exists("Controllers/".$controller.".php")){
    die("Le fichier Controllers/".$controller.".php n'existe pas");
}
include "Controllers/".$controller.".php";

$controller = "\\App\\Controllers\\".$controller;

if(!class_exists($controller)){
    die("La classe ".$controller." n'existe pas");
}
$objController = new $controller();

if(!method_exists($objController, $action)){
    die("L'action ".$action." n'existe pas");
}

$objController->$action();



