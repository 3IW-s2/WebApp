<?php

namespace App;
use App\Controllers\Installer;
use App\Core\Router;
use App\Core\Sitemap;
use App\Core\View;

session_start();
$timestamp = time();
$newTimestamp = strtotime('+2 hours', $timestamp);
$date = date('Y-m-d H:i:s', $newTimestamp);
$_SESSION["token_update_time"] = $date;



require 'vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', true);

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


$uri = $_SERVER["REQUEST_URI"];
if ($_SERVER['REQUEST_URI'] === '/sitemap.xml') {
    $sitemap = new Sitemap();
    $sitemap->generate();
    include './Views/Sitemap/sitemap.view.xml';
    exit();
}

if (!file_exists("routes.yml")) {
    die("Le fichier routes.yml n'existe pas");
}

$routes = yaml_parse_file("routes.yml");

$needInstall = Installer::checkNeedInstall();

if($needInstall["database"] && !$needInstall["installer_mode"]){
    new View("Auth/500" , "error");
    die();
}

$router = new Router($routes, $needInstall["installer_mode"]);

$installerRoutes = [
    "/api/database",
    "/api/user"
];

if(($needInstall["database"] || $needInstall["users"]) && $needInstall["installer_mode"]){
    if(!in_array($uri, $installerRoutes, true)){
        $uri = "install";
    }
    $isInstalling = true;
}

$router->handleRequest($uri);


